<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidarFacturaRequest;
use App\Models\DetallesFactura;
use App\Models\Factura;
use App\Models\Servicio;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $busqueda = trim($request->input('busqueda'));
      
      if($busqueda && $busqueda != ''){
        $facturas = DB::table('facturas')
                        ->where('comprobante','LIKE',"%$busqueda%")
                        ->orWhere('cliente','LIKE',"%$busqueda%")
                        ->orderByDesc('fecha')
                        ->orderByDesc('total')->paginate(10);
      } else {
        $facturas = DB::table('facturas')->orderByDesc('fecha')->orderByDesc('total')->paginate(10);
      }
                                  
      return view('facturas.index',['facturas' => $facturas,'busqueda' => $busqueda]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::all()->sortBy('descripcion');
        return view('facturas.create',[
            'servicios' => $servicios,
            'cant_detalles' => 5
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarFacturaRequest $request)
    {
      $importes = $request->input('importe');
      $codigos = $request->input('codigo');

      
      if(!Arr::whereNotNull($codigos)){
        return redirect()->route('facturas.create')->withInput()->with(['factura_error' => 'Debe ingresar al menos un item']);
      }

      DB::beginTransaction();
      try {
        $factura = new Factura();
        $factura->cliente = $request->input('cliente');
        $factura->fecha = $request->input('fecha');
        $factura->comprobante = $request->input('comprobante');
        $factura->estado = $request->input('estado');
        

        
        
        $total = 0;
        $arrDetalles = [];
        for ($i=0; $i < count($codigos); $i++) { 
          if($codigos[$i]){
            $detalle = new DetallesFactura();
            
            $detalle->servicio_id = $codigos[$i];
            $detalle->importe = $importes[$i];
            $total += $importes[$i];
            $arrDetalles[$i] = $detalle;
            
          }
        }

        $factura->total = $total;

        $factura->save();

        foreach ($arrDetalles as $det) {
          $det->factura_id = $factura->id;

          $det->save();
        }
        DB::commit();
        // return 'Factura #'.$factura->id.' guardada';
        return redirect()->route('facturas.index')->with(['message_success' => 'Factura guardada']);
      } catch(\Exception $err) {
        Log::error($err);

        DB::rollBack();

        return redirect()->route('facturas.create')->withInput()->with(['message_error' => 'Error al guardar factura']);
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
      // $factura = Factura::findOrFail($id);
      // $factura = Factura::find($id);
      // if(!$factura){
      //   return redirect()->route('facturas.index')->with(['message_error' => 'Factura #'.$id.' no encontrada']);
      // }

      $factura = Factura::findOrFail($id);
      // $detalles = DetallesFactura::where('factura_id',$factura->id)->get();

      return view('facturas.detail',['factura' => $factura]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $factura = Factura::findOrFail($id);

      // if(!$factura){
      //   return redirect()->route('facturas.index')->with(['message_error' => 'Factura #'.$id.' no encontrada']);
      // }

      $servicios = Servicio::all()->sortBy('descripcion');
      return view('facturas.edit',[
          'servicios' => $servicios,
          'factura' => $factura,
          'cant_detalles' => 5]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarFacturaRequest $request, $id)
    {

      // dd($request->collect());
      $factura = Factura::find($id);
      if(!$factura){
        return redirect()->route('facturas.index')->with(['message_error' => 'Factura #'.$id.' no encontrada']);
      }

      $detalles =$request->input('id');
      $importes = $request->input('importe');
      $codigos = $request->input('codigo');
      
      if(!Arr::whereNotNull($codigos)){
        return redirect()->route('facturas.edit',['factura' => $id])->withInput()->with(['factura_error' => 'Debe ingresar al menos un item']);
      }
      
      DB::beginTransaction();
      try {
        
        $factura->cliente = $request->input('cliente');
        $factura->fecha = $request->input('fecha');
        $factura->comprobante = $request->input('comprobante');
        $factura->estado = $request->input('estado');

        $total = 0;
        $arrDetalles = [];
        for ($i=0; $i < count($codigos); $i++) { 
          if($codigos[$i]){
            if($detalles[$i]){
              $detalle = DetallesFactura::find($detalles[$i]);
            } else {
              $detalle = new DetallesFactura();
            }
            
            $detalle->servicio_id = $codigos[$i];
            $detalle->importe = $importes[$i];
            $total += $importes[$i];
            $arrDetalles[$i] = $detalle;
          }
        }
        
        $factura->total = $total;
        $factura->save();

        foreach ($arrDetalles as $detalle) {
          $detalle->factura_id = $factura->id;
          $detalle->save();
          
        }
        DB::commit();
        
        return redirect()->route('facturas.index')->with(['message_success' => 'Factura actualizada']);
      } catch(\Exception $err) {
        Log::error($err);

        DB::rollBack();

        return redirect()->route('facturas.edit',['factura' => $id])->withInput()->with(['message_error' => 'Error al actualizar factura']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $factura = Factura::findOrFail($id);

      DB::beginTransaction();
      try {

        $factura->delete();

        DB::commit();
        return redirect()->route('facturas.index')->with(['message_success' => 'Factura eliminada']);
      } catch(\Exception $err) {
        Log::error($err);
        DB::rollBack();
        return redirect()->route('facturas.index')->with(['message_error' => 'Error al eliminar factura']);
      }

    }

    
}
