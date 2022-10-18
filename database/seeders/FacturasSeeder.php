<?php

namespace Database\Seeders;

use Carbon\Carbon;
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

      $data = [];

      for ($i=0; $i < 50; $i++) { 
        $data[$i] = [
          'cliente' => fake()->name(),
          'fecha' => Carbon::parse(fake()->dateTimeBetween('-1 year')->format('Y-m-d')),
          'comprobante' => rand(123122,429122),
          'estado' => rand(0,1),
          'total' => 0,
          'created_at' => now()
        ];
      }
      DB::table('facturas')->insert($data);
    }
}
