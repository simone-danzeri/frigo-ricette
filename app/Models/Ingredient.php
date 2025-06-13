<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    // Relazioni tra models
    public function recepies()
    {
        return $this->belongsToMany(Recepie::class, 'ingredient_recepie');
    }
}
