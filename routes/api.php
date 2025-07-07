<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\Api\RecipesController;

// Rotte API per Vue
Route::post('/groceries/generate/{recepie}', [GroceryController::class, 'generateFromRecepie']);
Route::post('/groceries/bought/{ingredient}', [GroceryController::class, 'markAsBought']);
Route::get('/groceries', [GroceryController::class, 'index']);

Route::get('/ingredients', [IngredientController::class, 'index']);

Route::get('/recipes', [RecipesController::class, 'index']);
Route::get('/recipes/{recepie}', [RecipesController::class, 'show']);
