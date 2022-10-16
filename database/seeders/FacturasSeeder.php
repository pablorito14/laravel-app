<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FacturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facturas')->insert([
            'cliente' => Str::random(20),
            'fecha' => now(),
            'comprobante' => 1231412,
            'estado' => 0,
            'created_at' => now()
        ]);
    }
}
