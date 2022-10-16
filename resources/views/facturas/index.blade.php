@extends('layout')

@section('content')
<div class="row">
  <div class="col-8">
    <h1>Listado de facturas</h1>
  </div>
  <div class="col-4 text-end">
    <a href="{{ route('facturas.create') }}" class="btn btn-success">Nueva factura</a>
  </div>
</div>

@include('messages')

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Comrobante</th>
      <th>Fecha</th>
      <th>Estado</th>
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
      <td>{{ ($factura->estado == 0) ? 'Pendiente' : 'Pagada' }}</td>
      <td><a href="{{ url('facturas/'.$factura->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a></td>
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