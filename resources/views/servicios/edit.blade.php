@extends('layout')
@section('title', 'Actualizar Servicio')
@section('content')
<div class="container mt-2">
  <div class="row justify-content-center">
    <div class="col-8">

      <div class="card">
        <div class="card-header">
          Actualizar Servicio
        </div>
        <div class="card-body">
        

          <!-- <form action="procesar.php?action=factura" method="POST"> -->
          <form action="{{ url('/servicios/'.$servicio->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" id="descripcion" 
                        class="form-control form-control-sm"
                        value="{{ $servicio->descripcion }}">
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
              <div class="form-group">
                  <label for="importe">Importe</label>
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="importe">$</span>
                    <input type="number" align="right" name="importe" 
                          class="form-control text-end" placeholder="0" 
                          aria-label="importe" aria-describedby="importe"
                          value="{{ $servicio->importe }}">
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