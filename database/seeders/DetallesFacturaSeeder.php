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
      $data = [];

      for ($i=0; $i < 100; $i++) { 
        $data[$i] = [
          'factura_id' => rand(118,167), // antes de ejectuar buscar el rango de id de facturas
          'servicio_id' => rand(63,82), // antes de ejectuar buscar el rango de id de servicios
          'importe' => rand(500,20000),
          'created_at' => now()
        ];
      }
      
      /** ejectar despues del seed */
      // delete from facturas where id in (select f.id from facturas f left join detalles_factura df on f.id = df.factura_id group by f.id HAVING count(df.id) = 0);
      // update facturas f set total = (select sum(importe) from detalles_factura df where df.factura_id = f.id);

      DB::table('detalles_factura')->insert($data);
    }
}
