<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre'=> 'Electronica',
            'descripcion'=> 'artículos de electrónica',
            'activa'=> 1,

        ]);
    }
}
