<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   /* public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('filtre_role')) {
            $query->where('role', $request->filtre_role);
        }

        if ($request->filled('filter_search')) {
            $search = $request->filter_search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('role', 'like', '%' . $search . '%');
            });
        }
       // dd($request->all());
       dd($query->toSql(), $request->all());
       $users = $query->latest()->distinct()->paginate(10);
        return view("users.index",compact("users"));
    }
*/
public function index(Request $request)
{
    $query = User::query();

    // Filtre par rôle
    if ($request->filled('filtre_role')) {
        $role = $request->filtre_role;
        if ($role !== 'all') {
            $query->where('role', $role);
        }
    }

    // Recherche
    if ($request->filled('filter_search')) {
        $search = $request->filter_search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('role', 'like', '%' . $search . '%');
        });
    }

    $users = $query->latest()->paginate(10);

    return view('users.index', compact('users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        // Création du user
        $user = User::create([        // Fait un INSERT dans la base.
        //'id' => auth()->id(), // ou auth()->user()->id
        'name' => $validated['name'],
        'email' => $validated['email'] ,
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
    ]);

      return to_route("users.index")->with('success', 'User created successfully.');
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
    public function edit(User $user)
    {

       return view("users.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
          //validation
       $validated = $request->validated();

          //update
        $user->update([
            'name' => $validated['name'] ,
            'email' => $validated['email'],
            'role'  => $validated['role'],
            'password' => $validated['password'],
        ]);

          return to_route("users.index")->with('success', 'User updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        //retour a la page precedante
       return to_route("users.index")->with('success', 'The User : '.$user->name .'  is deleted successfully.');
    //
    }
}
