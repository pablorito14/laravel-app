<?php

namespace App\Http\Controllers;

use App\Models\DetallesFactura;
use App\Models\Factura;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $titulo = 'Inicio';

        $facturas = Factura::all();
        
        
        return view('facturas.index',['facturas' => $facturas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulo = 'Nueva factura';

        $servicios = Servicio::all();
        return view('facturas.create',[
            'servicios' => $servicios,
            'detalles' => 5
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();
        try {
          $factura = new Factura();
          $factura->cliente = $request->input('cliente');
          $factura->fecha = $request->input('fecha');
          $factura->comprobante = $request->input('comprobante');
          $factura->estado = $request->input('estado');

          $factura->save();

          $codigos = $request->input('codigo');
          $importes = $request->input('importe');
          for ($i=0; $i < count($codigos); $i++) { 
            // if($codigos[$i]){
              $detalle = new DetallesFactura();
              $detalle->factura_id = $factura->id;
              $detalle->servicio_id = $codigos[$i];
              $detalle->importe = $importes[$i];

              $detalle->save();
            // }
          }
          DB::commit();
          // return 'Factura #'.$factura->id.' guardada';
          return redirect()->route('facturas.index')->with(['message_success' => 'Factura guardada']);
        } catch (\Throwable $th) {
          // echo '<pre>';
          // print_r($th->getMessage());
          // echo '</pre>';


          DB::rollBack();

          return redirect()->route('facturas.create')->withInput()->with(['message_error' => 'Error al guardar factura']);
          // return 'Error al guardar factura'; // por ahora tengo este error
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $factura = DetallesFactura::find($id);
        echo '<pre>';
        print_r($factura);
        echo '</pre>';

        echo '<pre>';
        print_r($factura->servicio);
        echo '</pre>';
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('facturas.edit',['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo '<pre>';
        print_r($id);
        echo '</pre>';


    }
}
