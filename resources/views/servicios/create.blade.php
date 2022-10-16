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
          @include('messages')
            
          <!-- <form action="procesar.php?action=factura" method="POST"> -->
          <form action="{{ url('/servicios') }}" method="POST">
            @csrf
            <div class="row mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" id="descripcion" 
                          class="form-control form-control-sm"
                          value="{{ old('descripcion') }}">
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="importe">Importe</label>
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="importe">$</span>
                    <input type="number" align="right" name="importe" min=0 
                          class="form-control text-end" placeholder="0" 
                          aria-label="importe" aria-describedby="importe"
                          value="{{ old('importe') }}">
                    </div>
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