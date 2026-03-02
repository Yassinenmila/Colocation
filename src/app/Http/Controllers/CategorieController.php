<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $categories = Categorie::where('colocation_id', $user->membreship->colocation_id)->get();
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
        $user = auth()->user();
        $colocation_id = $user->membreship->colocation_id;

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

    $exists = \App\Models\Categorie::where('name', $request->name)
        ->where('colocation_id', $colocation_id)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Cette catégorie existe déjà pour votre colocation.');
    }
    Categorie::create([
        'name' => $request->name,
        'colocation_id' => $colocation_id,
    ]);

    return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorie=Categorie::findOrFail($id);
        return view('categories.edit',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categorie = Categorie::findOrFail($id);
        $colocation_id = auth()->user()->membreship->colocation_id;

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $exists = Categorie::where('name', $request->name)
            ->where('colocation_id', $colocation_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Cette catégorie existe déjà pour votre colocation.');
        }

        $categorie->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(string $id)
    {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();

            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
