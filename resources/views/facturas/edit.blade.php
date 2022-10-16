@extends('layout')
@section('title', 'Editar factura')
@section('content')
<div class="container mt-2">
  <div class="row justify-content-center">
    <div class="col-8">

      <div class="card">
        <div class="card-header">
          Nueva factura
        </div>
        <div class="card-body">
        

          <!-- <form action="procesar.php?action=factura" method="POST"> -->
          <form action="{{ url('facturas/'.$id) }}" method="POST">
            @method("PUT")
            @csrf
            <div class="row align-items-end mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="cliente">Cliente</label>
                  <input type="text" name="cliente" id="cliente" class="form-control form-control-sm">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="fecha">Fecha</label>
                  <input type="date" name="fecha" id="fecha" class="form-control form-control-sm">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="comprobante">Nro de comprobante</label>
                  <input type="text" name="comprobante" id="comprobante" class="form-control form-control-sm">
                </div>
              </div>

              <div class="col d-grid">
                <button class="btn btn-primary btn-sm d-block" type="submit">Guardar</button>
              </div>
            </div>

          <!-- </form> -->

          <hr>

          <!-- Cabezera -->
          <div class="row">
            <div class="col-8 border-bottom- fw-bold">Código</div>
            <div class="col-4 border-bottom- fw-bold text-end">Importe</div>
          </div>

          <!-- detalles -->

          <!-- <form action="procesar.php?action=detalles" method="POST"> -->
            @for($i = 0; $i < 5; $i++)
            <div class="row">
              <div class="col-8">
              <select class="form-select form-select-sm" name="codigo_{{ $i }}" lang="es">
                <option value="1">select codigos... 111</option>
                <option value="2">select codigos... 222</option>
                <option value="3">select codigos... 333</option>
              </select>


                <!-- <div class="form-group">
                  <input type="text" name="codigo_1" id="codigo" class="form-control form-control-sm">
                </div> -->
              </div>
              <div class="col-4">
                <div class="form-group">
                  <!-- <label for="cliente">Importe</label> -->
                  <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="importe">$</span>
                    <input type="number" align="right" name="importe_{{ $i }}" class="form-control text-end" placeholder="0" aria-label="importe" aria-describedby="importe">
                  </div>
                </div>
              </div>
            </div>
            @endfor
            


            <div class="row justify-content-end">
              <div class="col-3">
                <div class="col d-grid">
                <button class="btn btn-primary btn-sm d-block" type="submit">Guardar</button>
              </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script>
  $(document).ready(function() {
      $('.form-select').select2({
        theme: 'bootstrap-5',
      });

      $('.form-select').on('select2:open', function (e) {
        $('input.select2-search__field')[0].focus();
      });
  });
</script>
@endsection