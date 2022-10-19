@extends('layout')
@section('title', 'Editar factura')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-8">

    <div class="card">
      
      <div class="card-body">
        <h3>Nueva Factura</h3>
        @include('messages')

        <!-- <form action="procesar.php?action=factura" method="POST"> -->
        <form action="{{ url('facturas/'.$factura->id) }}" method="POST" novalidate>
          @method("PUT")
          @csrf
          <div class="row mb-2">
            <div class="col-4">
              <div class="form-group">
                <label for="cliente">Cliente</label>
                <input type="text" name="cliente" id="cliente" 
                      class="form-control form-control-sm {{ $errors->has('cliente') ? 'custom-invalid' : '' }}"
                      value="{{ $factura->cliente }}">
                
                  <small class="form-text text-danger">{{ ($errors->has('cliente')) ?? $errors->first('cliente') }}</small>
                
              </div>
            </div>

            <div class="col-2">
              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" 
                        class="form-control form-control-sm  {{ $errors->has('fecha') ? 'custom-invalid' : '' }}" 
                        value="{{ $factura->fecha ?? now()->format('Y-m-d') }}">
                @if ($errors->has('fecha'))
                  <small class="form-text text-danger">{{ $errors->first('fecha') }}</small>
                @endif
              </div>
            </div>

            <div class="col-4">
              <div class="form-group">
                <label for="comprobante">Nro de comprobante</label>
                <input type="number" name="comprobante" id="comprobante" 
                        class="form-control form-control-sm {{ $errors->has('comprobante') ? 'custom-invalid' : '' }}"
                        value="{{ $factura->comprobante }}">
                @if ($errors->has('comprobante'))
                  <small class="form-text text-danger">{{ $errors->first('comprobante') }}</small>
                @endif
              </div>
            </div>

            <div class="col-2">
              <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control form-control-sm" name="estado" id="estado">
                  <option value="0" @selected($factura->estado == 0)>Pendiente</option>
                  <option value="1" @selected($factura->estado == 1)>Pagada</option>

                </select>
              </div>
            </div>
            
          </div>

        
          <section class="form-detalles border-top">
            <!-- Cabezera -->
            <div class="row mb-2">
              <div class="col-8 border-bottom- fw-bold">Código</div>
              <div class="col-4 border-bottom- fw-bold text-end">Importe</div>
            </div>

            <!-- detalles -->

          
            @for($i = 0; $i < $cant_detalles; $i++)
            <input type="hidden" value="{{ $factura->detalles[$i]->id ?? null }}" name="id[]">
            <div class="row">
              <div class="col-8">
                <select class="form-select form-select-sm" id="codigo_{{ $i }}"
                        name="codigo[]" lang="es" style="max-width: 100%;">
                  <option value="">-- Servicio --</option>
                  @foreach($servicios as $servicio )
                  <option value="{{ $servicio->id }}" importe="{{ $servicio->importe }}"
                          @selected(isset($factura->detalles[$i]) && ($factura->detalles[$i]->servicio_id == $servicio->id))>
                          {{ $servicio->descripcion }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <!-- <label for="cliente">Importe</label> -->
                  <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="importe">$</span>
                    <input type="number" align="right" name="importe[]" id="importe_{{ $i }}" class="form-control text-end" 
                            placeholder="0" aria-label="importe" aria-describedby="importe"
                            value="{{ (isset($factura->detalles[$i])) ? $factura->detalles[$i]->importe : '' }}">
                  </div>
                </div>
              </div>
            </div>
            @endfor
            
            @if (session('factura_error'))
            <div class="alert alert-danger py-1">
                {{ session('factura_error') }} 
            </div>
            @endif

            <div class="row justify-content-end">
              <div class="col-3">
                <div class="col d-grid">
                <button class="btn btn-primary btn-sm d-block" id="btn-guardar" type="submit">Guardar</button>
              </div>
              </div>
            </div>
          </section>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('plugins/select2@4.1.0/select2.min.css') }}">
<script src="{{ asset('plugins/select2@4.1.0/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2@4.1.0/es.js') }}"></script>
<link href="{{ asset('plugins/select2@4.1.0/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
<script>
  $(document).ready(function() {
    $('.form-select').select2({
      theme: 'bootstrap-5',
    });

    $('.form-select').on('select2:open', function(e) {
      $('input.select2-search__field')[0].focus();
    });

    $('.form-select').on('change',function(event) {

      let codigo_pos = $(this).attr('id').split('_')[1];
      let importe = $(this).find('option:selected').attr('importe');
      $(`#importe_${codigo_pos}`).val(importe);

    })

    $('#btn-guardar').click(function() {
      $(this).prop('disabled',true);
      $(this).append('<i class="fa-solid fa-spinner fa-spin-pulse ms-2"></i>');
      $('form').submit()
    });

  });
</script>
@endsection