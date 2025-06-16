<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recepie;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class GroceryController extends Controller
{
    /**
     * Display a listing of ingredients to buy.
     */
    public function index()
    {
        $groceries = DB::table('groceries')
        ->join('ingredients','groceries.ingredient_id','=','ingredients.id')
        ->select('ingredients.id','ingredients.name')
        ->get();
        return response()->json($groceries);
    }
    /**
     * Generate grocery list from a recepie
     */
    public function generateFromRecepie(Recepie $recepie)
    {
        $missingIngredients = $recepie->ingredients()
        ->where('is_available',false)
        ->get();
        foreach($missingIngredients as $ingredient) {
            DB::table('groceries')->updateOrInsert([
                'ingredient.id' => $ingredient->id
            ]);
        }
        return response()->json([
            'added' => $missingIngredients->pluck('name'),
            'message' => 'Ingredienti mancanti aggiunti alla lista della spesa'
        ]);
    }

    /**
     * Check an ingredients as bought
     */
    public function markAsBought(Ingredient $ingredient)
    {
        // Remove from groceries
        DB::table('groceries')
        ->where('ingredient_id', $ingredient->id)
        ->delete();
        // Update the ingredient
        $ingredient->update([
            'is_available' => true,
            'quantity' => $ingredient->quantity + 1
        ]);
        return response()->json([
            'message' => "{$ingredient->name} aggiornato e rimosso dalla lista della spesa."
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
