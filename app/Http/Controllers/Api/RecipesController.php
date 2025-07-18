<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recepie;

class RecipesController extends Controller
{
    public function index()
    {
        return response()->json(
            Recepie::with('ingredients')->get()
        );
    }

    public function show($slug)
    {
        $recipe = Recepie::with('ingredients')
                    ->where('slug', $slug)
                    ->firstOrFail();

        return response()->json($recipe);
    }

}
