<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function index(Request $request)
{
    //dd($request);
    $query = Ticket::query()
        ->with(['assignedAgent', 'category']);

    if ($request->filled('filter_status')) {
        $query->where('status', $request->filter_status);
    }

    if ($request->filled('filter_priority')) {
        $query->where('priority', $request->filter_priority);
    }

    if ($request->filled('filter_category')) {
        $query->where('category_id', $request->filter_category);
    }

    if ($request->filled('filter_assigned_to')) {
        $query->where('assigned_to', $request->filter_assigned_to);
    }

    if ($request->filled('filter_search')) {
        $search = $request->filter_search;
        $query->where(function ($q) use ($search) {
        $q->where('title', 'like', '%' . $search . '%')
          //->orWhere('message', 'like', '%' . $search . '%')
          ->orWhere('status', 'like', '%' . $search . '%')
          ->orWhere('priority', 'like', '%' . $search . '%')
          ->orWhereHas('assignedAgent', function ($qa) use ($search) {
              $qa->where('name', 'like', '%' . $search . '%');
          })
          ->orWhereHas('creator', function ($qc) use ($search) {
              $qc->where('name', 'like', '%' . $search . '%');
          })
          ->orWhereHas('category', function ($qcat) use ($search) {
              $qcat->where('name', 'like', '%' . $search . '%');
          })
         ->orWhereHas('labels', function ($qlabel) use ($search) {
              $qlabel->where('name', 'like', '%' . $search . '%');
          });
    });}

    $tickets = $query->latest()->distinct()->paginate(5);

    /* foreach ($tickets as $ticket) {
      dump([
        'id' => $ticket->id,
        'title' => $ticket->title,
        'message' => $ticket->message,
        'status' => $ticket->status,
        'priority' => $ticket->priority,
        'category' => $ticket->category?->name,
        'agent' => $ticket->assignedAgent?->name,
        'creator' => $ticket->creator?->name,
        'labels' => $ticket->labels->pluck('name')->toArray(),
    ]);}*/

        //$tickets = Ticket::latest()->paginate(5);
        $labels = Label::all()->unique('name');
        $categories = Category::all()->unique('name');
        $agents = User::where('role', 'agent')->get();

    return view('tickets.index', compact('tickets', 'labels', 'categories', 'agents'));
}



     /* Show the form for creating a new resource.
     */
    public function create()
    {

     //envoyer liste de agents
     $agents = User::where('role', 'agent')->get();

     //envoyer liste de labels
     $labels = Label::all()->unique('name'); //pour eviter d avoir les doublant on utilise *unique

     //envoyer liste de categories
     $categories = Category::all()->unique('name');
     return view("tickets.create",compact('labels', 'categories','agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {

      $validated = $request->validated(); // retourne uniquement les champs qui ont passé la validation.

        // Gestion des fichiers
        $attachmentPaths = [];

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $path = $file->store('tickets', 'public');
                $attachmentPaths[] = $path;
            }
        }

/*
        $creator_id = auth()->id();
User::where('id', $creator_id)->value('name'),
*/
    // Création du ticket
    $ticket = Ticket::create([        // Fait un INSERT dans la base.
        'created_by' => auth()->id(), // ou auth()->user()->id
        'assigned_to' => $validated['assigned_to'] ?? null,
        'category_id' => $validated['category_id'],
        'title'       => $validated['title'],
        'message'     => $validated['message'],
        'status'      => $validated['status'] ?? 'open',
        'priority'    => $validated['priority'] ?? 'medium',

        //Si valeur d un champs existe dans les données validées, on l’utilise.
        // Sinon, on met null .

        // Tu peux ajouter une colonne JSON pour les chemins des fichiers
        // 'attachments' => json_encode($attachmentPaths),
    ]);
    // Attacher les labels (relation many-to-many)
    if (!empty($validated['label'])) {
        $ticket->labels()->sync($validated['label']);
    }
    //$ticket->labels() est la relation many-to-many définie dans le modèle Ticket.
    //sync([...]) : insère les lignes nécessaires dans la table pivot ticket_label




      return to_route("tickets.index")->with('success', 'Ticket created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // $ticket = Ticket::findOrFail($ticket); // no need
     $labels = Label::all()->unique('name');
     $categories = Category::all()->unique('name');
     $agents = User::where('role', 'agent')->get();
     return view("tickets.edit",compact('labels', 'categories','ticket','agents'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

    // 1. Mettre à jour les champs du ticket
    $ticket->update([
        'assigned_to' => $validated['assigned_to'] ?? null,
        'category_id' => $validated['category_id'],
        'title'       => $validated['title'],
        'message'     => $validated['message'],
        'status'      => $validated['status'] ?? $ticket->status,
        'priority'    => $validated['priority'] ?? $ticket->priority,
    ]);

    // 2. Mettre à jour les labels
    if (isset($validated['label'])) {
        $ticket->labels()->sync($validated['label']);
    }

    // 3. Gérer les nouveaux fichiers
    if ($request->hasFile('attachment')) {
        foreach ($request->file('attachment') as $file) {
            $path = $file->store('tickets', 'public');

            // Si tu as une table ticket_attachments
           /* DB::table('ticket_attachments')->insert([
                'ticket_id' => $ticket->id,
                'file_path' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);*/
        }
    }

    // 4. Redirection avec message de succès
    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //$ticket = Ticket::findOrFail($ticket);
        $ticket->delete();

        //retour a la page precedante
       return to_route("tickets.index")->with('success', 'Ticket deleted successfully.');
    }
}
