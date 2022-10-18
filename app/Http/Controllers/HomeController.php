<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      $data = [];

      for ($i=0; $i < 50; $i++) { 
        $data[$i] = [
          'cliente' => fake()->name(),
          'fecha' => now(),
          'fecha2' => fake()->dateTimeBetween('-1 year')->format('Y-m-d'),
          'fecha3' => Carbon::parse('2022-11-22'),
          'fecha4' => Carbon::parse(fake()->dateTimeBetween('-1 year')->format('Y-m-d')),
          'comprobante' => rand(123122,429122),
          'estado' => rand(0,1),
          'total' => 0,
          'created_at' => now()
        ];
      }
      echo dd($data[0]);

    }
}
