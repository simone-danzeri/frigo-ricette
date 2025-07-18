<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recepie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GroceriesController extends Controller
{
    public function generateFromRecepie(Recepie $recepie)
    {
        // Trova gli ingredienti mancanti (non disponibili o esauriti)
        $missingIngredients = $recepie->ingredients()
            ->where(function ($query) {
                $query->where('is_available', false)
                      ->orWhere('quantity', '<=', 0);
            })
            ->get();

        // Inserisce o aggiorna gli ingredienti mancanti nella lista della spesa
        foreach ($missingIngredients as $ingredient) {
            DB::table('groceries')->updateOrInsert(
                ['ingredient_id' => $ingredient->id],
                ['updated_at' => Carbon::now()]
            );
        }

        return response()->json(['message' => 'Ingredienti aggiunti alla lista della spesa!']);
    }
}
