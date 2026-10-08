<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Label::query();
        // Filtre
        if ($request->filled('filtre_visible')) {
            $is_visible = $request->filtre_visible;
            if ($is_visible !== 'all') {
                $query->where('is_visible', $is_visible);
            }
        }

        // Recherche
        if ($request->filled('filter_search')) {
            $search = $request->filter_search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%')
                  ->orWhere('is_visible', 'like', '%' . $search . '%');

                    // Gestion spéciale pour "no" / "yes"
                    $searchLower = strtolower($search);

                    if ($searchLower === 'no') {
                        $q->orWhere('is_visible', false);
                    } elseif ($searchLower === 'yes') {
                        $q->orWhere('is_visible', true);
                    }
                });
        }
   //dd($request->query->all());

            $labels = $query->latest()->distinct()->paginate(8);
            return view('labels.index', compact('labels'));
       }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(LabelRequest $request)
    {

      //validation
      $validated = $request->validated();

      //ajout dans la BDD
      $label=Label::create(
      [
        'name' => $validated["name"] ,
        'description' => $validated['description'] ?? null,
        'slug'       =>Str::slug($validated['description']),
        'is_visible' => $validated['is_visible'],
      ]
      );

        return to_route("labels.index")->with('success', 'label added successfully.');
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
    public function edit( label $label)
    {
       return view("labels.edit",compact("label"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelRequest $request, label $label)
    {
           //validation
        $validated = $request->validated();

        //Update dans la BDD
        $label->update (
        [
            'name' => $validated["name"] ,
            'description' => $validated['description'] ?? null,
            'slug'       =>Str::slug($validated['description']),
            'is_visible' => $validated['is_visible'],
        ]
        );
         return to_route("labels.index")->with('success', 'label updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
       $label->delete();

        return to_route("labels.index")->with('success', 'label deleted successfully.');
    }
}
