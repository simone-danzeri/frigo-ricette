<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\IngredientController;

// Rotte API per Vue
Route::post('/groceries/generate/{recepie}', [GroceryController::class, 'generateFromRecepie']);
Route::post('/groceries/bought/{ingredient}', [GroceryController::class, 'markAsBought']);
Route::get('/groceries', [GroceryController::class, 'index']);

Route::get('/ingredients', [IngredientController::class, 'index']);
