<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\IngredientController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('ingredients', IngredientController::class)
->parameters(['ingredients' => 'ingredient:slug']);
