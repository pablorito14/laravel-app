@extends('layout')

@section('content')
<h1>Listado de Servicios</h1>
<a href="{{ url('servicios/create') }}" class="btn btn-success">Boton</a>

<!-- <form action="" method="POST">
  @csrf
  @method("DELETE")
  <button class="btn btn-danger" type="submit">Eliminar </button>
</form> -->

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
      <td></td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>


@endsection