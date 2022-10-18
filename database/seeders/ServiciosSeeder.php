<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = [];

      for ($i=0; $i < 20; $i++) { 
        $data[$i] = [
          // 'descripcion' => Str::random(20),
          'descripcion' => fake()->words(3, true),
          'importe' => rand(500,20000),
          'created_at' => now()
        ];
      }
      DB::table('servicios')->insert($data);
      /** SEED */
      // php artisan db:seed --class=ServiciosSeeder
    }
}
