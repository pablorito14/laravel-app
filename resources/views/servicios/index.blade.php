@extends('layout')

@section('content')

<div class="row">
  <div class="col-8">
    <h1>Listado de Servicios</h1>
  </div>
  <div class="col-4 text-end">
    <a href="{{ url('servicios/create') }}" class="btn btn-success">Agregar servicio</a>
  </div>
</div>




@include('messages')
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Descripcion</th>
      <th>Importe</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($servicios as $servicio)
    <tr>
      <td>{{ $servicio->id }}</td>
      <td>{{ $servicio->descripcion }}</td>
      <td>{{ $servicio->importe }}</td>
      <td>
        <a href="{{ url('servicios/'.$servicio->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
      </td>
      <td>
        <form action="{{ url('servicios/'.$servicio->id) }}" method="POST">
          @csrf
          @method("DELETE")
          <button class="btn btn-sm btn-danger" type="submit">Eliminar </button>
        </form>
      </td>
      
    </tr>
    @endforeach
  </tbody>
</table>

@endsection