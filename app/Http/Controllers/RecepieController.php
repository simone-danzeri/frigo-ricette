<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recepie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecepieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recepies = Recepie::with('ingredients')->get();
        return view('recepies.index', compact('recepies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::select('id', 'name')->get();
        return view('recepies.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:recepies,name',
        'process' => 'required|string',
        'ingredient_ids' => 'array',
        'ingredient_ids.*' => 'exists:ingredients,id',
    ]);

    $recepie = Recepie::create([
        'name' => $validated['name'],
        'slug' => Str::slug($validated['name']),
        'process' => $validated['process'],
    ]);

    $recepie->ingredients()->sync($validated['ingredient_ids'] ?? []);

    return redirect()->route('recepies.index')->with('success', 'Ricetta creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recepie $recepie)
    {
        return view('recepies.show', compact('recepie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recepie $recepie)
    {
        $allIngredients = Ingredient::select('id', 'name')->get(); // nome coerente
        $recepieIngredients = $recepie->ingredients()->pluck('ingredients.id')->toArray();

        return view('recepies.edit', compact('recepie', 'allIngredients', 'recepieIngredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recepie $recepie)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'process' => 'required|string',
        'ingredient_ids' => 'array',
        'ingredient_ids.*' => 'exists:ingredients,id',
    ]);

    $recepie->update([
        'name' => $validated['name'],
        'slug' => Str::slug($validated['name']),
        'process' => $validated['process'],
    ]);

    $recepie->ingredients()->sync($validated['ingredient_ids'] ?? []);

    return redirect()->route('recepies.index')->with('success', 'Ricetta aggiornata!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recepie $recepie)
    {
        $recepie->delete();
        return redirect()->route('recepies.index')->with('success', 'Ricetta cancellata con successo!');
    }
}
