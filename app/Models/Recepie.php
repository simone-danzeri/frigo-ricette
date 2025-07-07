<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recepie extends Model
{
    //
    protected $fillable = ['id', 'name', 'slug', 'process'];
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recepie');
    }
    // Usa lo slug come chiave per il route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Genera lo slug automaticamente quando crei o aggiorni il modello
    protected static function booted()
    {
        static::creating(function ($recepie) {
            $recepie->slug = Str::slug($recepie->name);
        });

        static::updating(function ($recepie) {
            if ($recepie->isDirty('name')) {
                $recepie->slug = Str::slug($recepie->name);
            }
        });
    }
}
