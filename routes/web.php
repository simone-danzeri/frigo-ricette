<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceryController;
use App\Models\Grocery;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-groceries', function() {
    return view('groceries/test-groceries');
});
Route::post('/grocery/{ingredient}/bought', [GroceryController::class, 'markAsBought'])->name('grocery.bought');
