<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('deleted_at', null)->paginate(10); // Add pagination (10 items per page)
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
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:25',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);    
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:25',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Catégorie modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!request()->confirm) {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('categories.delete', compact('categories', 'category'));
        } else {
            if(Category::count() == 1) {
                return redirect()->route('categories.index')->with('error', 'Il ne reste qu\'une seule catégorie, vous ne pouvez pas la supprimer.');
            } else if(request()->confirm == $id) {
                return redirect()->back()->with('error', 'Merci de choisir une autre catégorie afin de transférer les tickets attribués à celle à supprimer.');
            }
            $category = Category::findOrFail($id);
            $category->deleted_at = now();

            // Take all tickets from the category to delete and assign them to the category selected by the user
            $tickets = $category->tickets;
            foreach($tickets as $ticket) {
                $ticket->category_id = request()->confirm;
                $ticket->save();
            }

            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
        }
    }
}
