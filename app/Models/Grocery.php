<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grocery extends Model
{
    //
    protected $fillable = ['ingredient_id'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
