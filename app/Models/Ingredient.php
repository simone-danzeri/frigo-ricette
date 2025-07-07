<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ingredient extends Model
{
    protected $fillable = ['name', 'slug', 'quantity', 'is_available'];
    // Relazioni tra models
    public function recepies()
    {
        return $this->belongsToMany(Recepie::class, 'ingredient_recepie');
    }

    // Usa lo slug come chiave per il route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Genera lo slug automaticamente quando crei o aggiorni il modello
    protected static function booted()
    {
        static::creating(function ($ingredient) {
            $ingredient->slug = Str::slug($ingredient->name);
        });

        static::updating(function ($ingredient) {
            if ($ingredient->isDirty('name')) {
                $ingredient->slug = Str::slug($ingredient->name);
            }
        });
    }
}
