<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\IngredientController;
use App\Models\Grocery;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ingredients', IngredientController::class);
