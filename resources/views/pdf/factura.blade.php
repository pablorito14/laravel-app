

  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #{{ $factura->id }}</title>
    
    <style>
      .py-2{
        padding-top: .5rem;
        padding-bottom: .5rem;
      }

      .px-2{
        padding-left: .5rem;
        padding-right: .5rem;
      }

      .my-2{
        margin-top: .5rem;
        margin-bottom: .5rem;
      }
      .mt-0{
        margin-top: 0;
      }

      .mt-3{
        margin-top: 1.5rem;
      }

      .fw-bold{
        font-weight: bold;;
      }

      .text-end{
        text-align: right;
      }

      .text-start{
        text-align: left;
      }
      table{
        caption-side: bottom;
        border-collapse: collapse;
      }

      .table{
        width: 100%;
        color: #212529;
        vertical-align: top;
      }

      tbody, td {
        border-color: #dee2e6;
        border-style: solid;
        border-width: 1px 0px;
       
        padding-top: .5rem;
        padding-bottom: .5rem;
        padding-left: .5rem;
        padding-right: .5rem;
      }

      th,thead{
        border-width: 0px 0px 3px 0px;
        border-color: #dee2e6;
        border-style: solid;
        padding-top: .5rem;
        padding-bottom: .5rem;
        padding-left: .5rem;
        padding-right: .5rem;
      }

      
    </style>
  </head>
  <body>

  <h2>Factura #{{ $factura->id }}</h2>

  <p class="my-2"><span class="fw-bold">Cliente:</span> {{ $factura->cliente }}</p>
  <p class="my-2"><span class="fw-bold">Fecha:</span> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $factura->fecha)->format('d/m/Y') }}</p>
  <p class="my-2"><span class="fw-bold">Nro de comprobante:</span> {{ $factura->comprobante }}</p>
  <p class="my-2"><span class="fw-bold">Estado:</span> {{ $factura->estado == 0 ? 'Pendiente' : 'Pagada' }}</p>

  <table class="mt-3 table">
    <thead>
      <th class="text-start">Servicio</th>
      <th class="text-end">Importe</th>
    </thead>
    <tbody>
      @foreach($factura->detalles as $detalle)
      <tr>
        <td>{{ $detalle->servicio->descripcion }}</td>
        <td class="text-end">$ {{ $detalle->importe }}</td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  <p class="mt-0 text-end fw-bold px-2 py-2">Total: $ {{ $factura->total }}</p>
  
  </body>
  </html>