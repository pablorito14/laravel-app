@extends('layout')
@section('title','Listado de Facturas')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-10">
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-8">
            <h2>Listado de Facturas</h2>
          </div>
          <div class="col-4 text-end">
            <a href="{{ route('facturas.create') }}" class="btn btn-sm btn-success">Agregar factura</a>
          </div>
        </div>
        @include('messages')

        <table class="table">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 30%;">Cliente</th>
              <th class="text-end">Comrobante</th>
              <th class="text-end">Importe</th>
              <th class="text-end" style="width: 10%;">Fecha</th>
              <th class="text-center" style="width: 10%;">Estado</th>
              <th style="width: 5%;"></th>
              <th style="width: 5%;"></th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($facturas as $factura)
            <tr class="align-middle">
              <td>{{ $factura->id }}</td>
              <td>{{ $factura->cliente }}</td>
              <td class="text-end">{{ $factura->comprobante }}</td>
              <td class="text-end">$ {{ $factura->total }}</td>
              <td class="text-end">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $factura->fecha)->format('d/m/Y') }}</td>
              <td class="text-center">
                @if($factura->estado == 0)
                <span class="alert alert-primary d-block py-1 mb-0"><small>Pendiente</small></span>
                @elseif($factura->estado == 1)
                <span class="alert alert-success d-block py-1 mb-0"><small>Pagada</small></span>
                @else
                <span class="alert alert-danger py-1">error</span>
                @endif
              </td>
              <td><a href="{{ url('facturas/'.$factura->id) }}" class="btn btn-sm btn-dark d-block">Ver</a></td>
              <td><a href="{{ url('facturas/'.$factura->id.'/edit') }}" class="btn btn-sm btn-primary d-block">Editar</a></td>
              <td>
                <form action="{{ url('facturas/'.$factura->id) }}" method="POST" id="form-{{ $factura->id }}">
                  @csrf
                  @method("DELETE")
                  <button class="btn btn-sm btn-danger d-block btn-eliminar" type="submit" data-value="{{ $factura->id }}">Eliminar </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="row">
          <div class="col">
          {{ $facturas->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<link rel="stylesheet" href="{{ asset('plugins/jQuery-Confirm@3.2.2/jquery-confirm.min.css') }}">
<script src="{{ asset('plugins/jQuery-Confirm@3.2.2/jquery-confirm.min.js') }}"></script>
<script>
  $(document).ready(function(){

    $('.btn-eliminar').click(function(e){
      servicio = $(this).attr('data-value');
      e.preventDefault();
    
      $.confirm({
        title: 'Confirmar eliminacion!',
        content: `Quiere eliminar la factura #${servicio}`,
        type: 'red',
        typeAnimated: true,
        buttons: {
          eliminar:{
            btnClass: 'btn-red', 
            action: function () {
              $('.btn-eliminar').prop('disabled',true);
              $(`#form-${servicio}`).submit();
            }
          },
          cancelar: function () {
          },
        }
      });
    })
  });
</script>
@endsection