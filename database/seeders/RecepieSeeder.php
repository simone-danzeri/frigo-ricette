<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recepie;
use Illuminate\Support\Facades\DB;

class RecepieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recepies = config('recepies');

        foreach ($recepies as $data) {
            // Crea la ricetta
            $recepie = Recepie::create([
                'id' => $data['id'],
                'name' => $data['name'],
                'slug' => $data['slug'],
                'process' => $data['process'],
            ]);

            // Collega gli ingredienti via tabella pivot
            $recepie->ingredient()->attach($data['ingredient_ids']);
        }
    }
}
