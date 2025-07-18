<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipesController;
use App\Http\Controllers\Api\GroceriesController;

// Rotte API per Vue
Route::get('/recipes', [RecipesController::class, 'index']);
Route::get('/recipes/{slug}', [RecipesController::class, 'show']);
Route::post('/groceries/generate/{recepie}', [GroceriesController::class, 'generateFromRecepie']);
Route::post('/groceries/bought/{ingredient}', [GroceriesController::class, 'markAsBought']);
Route::get('/groceries', [GroceriesController::class, 'index']);
