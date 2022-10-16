@extends('layout')

@section('content')
<h1>Listado de facturas</h1>
<a href="{{ route('facturas.create') }}" class="btn btn-success">Nueva factura</a>

<!-- <form action="" method="POST">
  @csrf
  @method("DELETE")
  <button class="btn btn-danger" type="submit">Eliminar </button>
</form> -->


<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Comrobante</th>
      <th>Fecha</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($facturas as $factura)
    <tr>
      <td>{{ $factura->id }}</td>
      <td>{{ $factura->cliente }}</td>
      <td>{{ $factura->comprobante }}</td>
      <td>{{ $factura->fecha }}</td>
      <td><a href="{{ url('facturas/'.$factura->id) }}">ver</a></td>
      <td>
        <form action="{{ url('facturas/'.$factura->id) }}" method="POST">
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