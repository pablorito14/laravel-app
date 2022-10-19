@extends('layout')
@section('title', 'Detalle de factura')
@section('content')
  <div class="row justify-content-center mt-3">
    <div class="col-8">
      <div class="card shadow">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-5">
              <h3>Factura #{{ $factura->id }}</h3>
            </div>
            <div class="col-7 text-end d-flex- justify-content-end-">
              @if($factura->estado == 0)
              <span class="alert alert-primary py-1 px-5 mb-0 d-inline-flex"><small>Pendiente</small></span>
              <form action="{{ url('facturas/'.$factura->id) }}" method="POST" class="d-inline-flex">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm ms-3 px-4 d-flex- btn-eliminar">Eliminar</button>
              </form>
              
              @elseif($factura->estado == 1)
              <span class="alert alert-success py-1 px-5 mb-0"><small>Pagada</small></span>
              @else
              <span class="alert alert-danger py-1">error</span>
              @endif
              <a class="btn btn-outline-primary btn-sm ms-3 px-4- d-inline-flex" href="{{ url('facturas/'.$factura->id.'/pdf') }}" target="_blank">Generar PDF</a>

            </div>
          </div>

          
          <p class="my-2"><span class="fw-bold">Cliente:</span> {{ $factura->cliente }}</p>
          <p class="my-2"><span class="fw-bold">Fecha:</span> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $factura->fecha)->format('d/m/Y') }}</p>
          <p class="my-2"><span class="fw-bold">Nro de comprobante:</span> {{ $factura->comprobante }}</p>

          <table class="table">
            <thead>
              <th>Servicio</th>
              <th class="text-end">Importe</th>
            </thead>
            <tbody>
              @foreach($detalles as $detalle)
              <tr>
                <td>{{ $detalle->servicio->descripcion }}</td>
                <td class="text-end">$ {{ $detalle->importe }}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          <p class="text-end fw-bold px-2">Total: $ {{ $factura->total }}</p>

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
              $(`form`).submit();
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