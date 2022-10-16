<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DetallesFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalles_factura')->insert([
            'factura_id' => 1,
            'servicio_id' => 3,
            'importe' => 2000,
            'created_at' => now()
        ]);
    }
}
