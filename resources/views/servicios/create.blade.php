@extends('layout')
@section('title', 'Agregar Servicio')
@section('content')
<div class="container mt-2">
  <div class="row justify-content-center">
    <div class="col-8">

      <div class="card">
        <div class="card-header">
          Agregar Servicio
        </div>
        <div class="card-body">
        
            
          <!-- <form action="procesar.php?action=factura" method="POST"> -->
          <form action="{{ url('/servicios') }}" method="POST">
            @csrf
            <div class="row mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" id="descripcion" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="importe">Importe</label>
                  <input type="number" min="0" name="importe" id="importe" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col d-grid">
                <button class="btn btn-primary btn-sm d-block" type="submit">Guardar</button>
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
@endsection