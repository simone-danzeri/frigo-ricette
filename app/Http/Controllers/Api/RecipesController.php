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

    public function show(Recepie $recepie)
    {
        return response()->json($recepie->load('ingredients'));
    }
}
