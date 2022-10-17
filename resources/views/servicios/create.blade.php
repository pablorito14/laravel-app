@extends('layout')
@section('title', 'Nuevo Servicio')
@section('content')

  <div class="row justify-content-center mt-3">
    <div class="col-4">

      <div class="card shadow">
        <div class="card-body">
          <h3>Nuevo Servicio</h3>
          @include('messages')
            
          <form action="{{ url('/servicios') }}" method="POST" novalidate>
            @csrf
            <div class="row mb-2">
              <div class="col">
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" name="descripcion" id="descripcion" 
                          class="form-control form-control-sm {{ $errors->has('descripcion') ? 'custom-invalid' : '' }}"
                          value="{{ old('descripcion') }}">
                  @if ($errors->has('descripcion'))
                      <small class="form-text text-danger">{{ $errors->first('descripcion') }}</small>
                  @endif
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
                          class="form-control text-end {{ $errors->has('descripcion') ? 'custom-invalid' : '' }}" 
                          placeholder="0" aria-label="importe" aria-describedby="importe"
                          value="{{ old('importe') }}">
                  </div>
                  @if ($errors->has('importe'))
                      <small class="form-text text-danger">{{ $errors->first('importe') }}</small>
                  @endif
                </div>
                
                
              </div>
            </div>
            <div class="row justify-content-end mb-2">
              <div class="col-4 mt-2 d-grid">
                <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
              </div>
            </div>

          
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script>
  // $(document).ready(function(){
  //   $('#descripcion').on('keyup keypress',function(){
  //     if($(this).val() == ''){
  //       $(this).addClass('custom-invalid');
        
  //     } else {
  //       $(this).removeClass('custom-invalid');
  //     }
  //   })
  // })
</script>

@endsection