<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index',['servicios' => $servicios]);
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
    public function store(Request $request)
    {
      
      try {
        $servicio = new Servicio();
        $servicio->descripcion = $request->input('descripcion');
        $servicio->importe = $request->input('importe');

        $servicio->save();
        
        return redirect()->route('servicios.index')->with(['message_success' => 'Servicio agregado']);
      } catch (\Throwable $th) {
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servicio::find($id);
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
        $servicio->descripcion = $request->input('descripcion');
        $servicio->importe = $request->input('importe');
        $servicio->save();

        return 'Servicio modificado';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $servicio = Servicio::find($id);
        $servicio->delete();

        return redirect()->route('servicios.index')->with(['message_success' => 'Servicio eliminado']);
      } catch (\Throwable $th) {
        //throw $th;
        return redirect()->route('servicios.index')->with(['message_error' => 'Error al eliminar servicio']);
      }
        
    }
}
