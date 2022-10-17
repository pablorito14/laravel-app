@extends('layout')
@section('title', 'Detalle de factura')
@section('content')
  <div class="row justify-content-center mt-3">
    <div class="col-8">
      <div class="card shadow">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-8">
              <h3>Factura #{{ $factura->id }}</h3>
            </div>
            <div class="col-4 text-end">
              @if($factura->estado == 0)
              <span class="alert alert-primary py-1 mb-0"><small>Pendiente</small></span>
              @elseif($factura->estado == 1)
              <span class="alert alert-success py-1 mb-0"><small>Pagada</small></span>
              @else
              <span class="alert alert-danger py-1">error</span>
              @endif
            </div>
          </div>

          <!-- <h3>Factura #{{ $factura->id }}</h3> -->
          <!-- <hr> -->
          <p class="my-2"><span class="fw-bold">Cliente:</span> {{ $factura->cliente }}</p>
          <p class="my-2"><span class="fw-bold">Fecha:</span> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $factura->fecha)->format('d/m/Y') }}</p>
          <p class="my-2"><span class="fw-bold">Nro de comprobante:</span> {{ $factura->comprobante }}</p>

          <!-- <hr> -->

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

@endsection