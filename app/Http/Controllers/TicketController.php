<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::latest()->paginate(5);

        return view("tickets.index",compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     //envoyer liste de labels
     $labels = Label::all()->unique('name'); //pour eviter d avoir les doublant on utilise *unique

     //envoyer liste de categories
     $categories = Category::all()->unique('name');
     return view("tickets.create",compact('labels', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       //créer TicketRequest pour faire les régles

       //verification et validation

       //sauvegarde de données dans la BDD

       //retour a la page precedante

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
