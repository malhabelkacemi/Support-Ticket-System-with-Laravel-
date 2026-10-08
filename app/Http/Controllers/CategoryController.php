<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
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

      $categories = $query->latest()->distinct()->paginate(8);
      return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

      //validation
      $validated = $request->validated();

      //ajout dans la BDD
      $category=Category::create(
      [
        'name' => $validated["name"] ,
        'description' => $validated['description'] ?? null,
        'slug'       =>Str::slug($validated['description']),
        'is_visible' => $validated['is_visible'],
      ]
      );

        return to_route("categories.index")->with('success', 'Category added successfully.');
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
    public function edit(Category $category)
    {

      return view("categories.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        //validation
        $validated = $request->validated();

        //Update dans la BDD
        $category->update (
        [
            'name' => $validated["name"] ,
            'description' => $validated['description'] ?? null,
            'slug'       =>Str::slug($validated['description']),
            'is_visible' => $validated['is_visible'],
        ]
        );
         return to_route("categories.index")->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
          $category->delete();
          return to_route("categories.index")->with('success', 'Category deleted successfully.');
    }
}
