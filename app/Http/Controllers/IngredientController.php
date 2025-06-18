<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required|string|max:255'
        ]);
        $formData = $request->all();
        $newIngredient = new Ingredient();
        $newIngredient['name'] = $formData['name'];
        $newIngredient['slug'] = Str::slug($formData['name'], '-');
        $newIngredient['is_available'] = true;
        $newIngredient['quantity'] = 1;
        $newIngredient->save();
        return redirect()->route('ingredients.show', ['ingredient' => $newIngredient->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $ingredient->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'quantity' => $validated['quantity'] ?? 1,
            'is_available' => $request->has('is_available'),
        ]);
        return redirect()->route('ingredients.index')->with('success', 'Ingrediente aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
