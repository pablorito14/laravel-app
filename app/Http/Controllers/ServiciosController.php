<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidarServicioRequest;
use App\Models\DetallesFactura;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiciosController extends Controller
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
        $servicios = DB::table('servicios')
                        ->where('descripcion','LIKE',"%$busqueda%")
                        ->orderBy('descripcion')
                        ->paginate(10);
      } else {
        $servicios = DB::table('servicios')
                        ->orderBy('descripcion')
                        ->paginate(10);
      }
        
      return view('servicios.index',['servicios' => $servicios, 'busqueda' => $busqueda]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarServicioRequest $request)
    {

      //validar si no hay otro servicio con el mismo nombre si se necesita

      try {
        $servicio = new Servicio();
        $servicio->descripcion = $request->input('descripcion');
        $servicio->importe = $request->input('importe');

        $servicio->save();
        
        return redirect()->route('servicios.index')->with(['message_success' => 'Servicio agregado']);
      } catch(\Exception $err) {
        Log::error($err);
        return redirect()->route('servicios.create')
                        ->withInput()
                        ->with(['message_error' => 'Error al guardar servicio']);
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
        // return '404 - NOT FOUND';
        return redirect()->route('servicios.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicio = Servicio::findOrFail($id);
      // if(!$servicio){
      //   return redirect()->route('servicios.index')->with(['message_error' => 'Servicio #'.$id.' no encontrado']);
      // }
      
      
      return view('servicios.edit',['servicio' => $servicio]);
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
      $servicio = Servicio::find($id);
      if(!$servicio){
        return redirect()->route('servicios.index')->with(['message_error' => 'Servicio #'.$id.' no encontrado']);
      }

      try {
        $servicio = Servicio::find($id);
        $servicio->descripcion = $request->input('descripcion');
        $servicio->importe = $request->input('importe');
        $servicio->save();

        return redirect()->route('servicios.index')->with(['message_success' => 'Servicio actualizado']);
      } catch(\Exception $err) {
        Log::error($err);
        return redirect()->route('servicios.edit',['servicio' => $id])->withInput()->with(['message_error' => 'Error al actualizar servicio']);
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
      $servicio = Servicio::findOrFail($id);
      // if(!$servicio){
      //   return redirect()->route('servicios.index')->with(['message_error' => 'Servicio #'.$id.' no encontrado']);
      // }

      $detalles = DetallesFactura::where('servicio_id',$id)->get();
      if(count($detalles) > 0){
        return redirect()->route('servicios.index')->with(['message_error' => 'El servicio no se puede eliminar porque fue utilizado en facturas']);
      } 

      try {
        // $servicio = Servicio::find($id);
        $servicio->delete();

        return redirect()->route('servicios.index')->with(['message_success' => 'Servicio eliminado']);
      } catch(\Exception $err) {
        Log::error($err);
        return redirect()->route('servicios.index')->with(['message_error' => 'Error al eliminar servicio']);
      }
        
    }
}
