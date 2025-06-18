<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecepieController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('ingredients', IngredientController::class)
->parameters(['ingredients' => 'ingredient:slug']);

Route::resource('recepies', RecepieController::class)
->parameters(['recepies' => 'recepie:slug']);
