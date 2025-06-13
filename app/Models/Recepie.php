<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recepie extends Model
{
    //
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recepie');
    }
}
