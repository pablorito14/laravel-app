<h1>GENERAR PDF</h1>
<P>Cliente: {{ $factura->cliente }}</P>

@foreach($factura->detalles as $index => $detalles)
<ol>
  <li>{{ $detalles->servicio->descripcion }}</li>
</ol>
@endforeach