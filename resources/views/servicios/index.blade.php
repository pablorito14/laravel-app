@extends('layout')
@section('title','Listado de Servicios')
@section('content')
<div class="row justify-content-center mt-3">
  <div class="col-10">

  
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-8 text-end-">
            <h2>Listado de Servicios</h2>
          </div>
          <div class="col-4 text-end">
            <a href="{{ url('servicios/create') }}" class="btn btn-sm btn-success">Agregar servicio</a>
          </div>
        </div>
  
        @include('messages')
        <table class="table">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 50%;">Descripcion</th>
              <th style="width: 10%; text-align: right;">Importe</th>
              <th style="width: 5%;"></th>
              <th style="width: 5%;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($servicios as $servicio)
            <tr class="align-middle">
              <td>{{ $servicio->id }}</td>
              <td>{{ $servicio->descripcion }}</td>
              <td class="text-end">$ {{ $servicio->importe }}</td>
              <td>
                <a href="{{ url('servicios/'.$servicio->id.'/edit') }}" class="btn btn-sm btn-primary d-block">Editar</a>
              </td>
              <td>
                <form action="{{ url('servicios/'.$servicio->id) }}" method="POST" id="form-{{ $servicio->id }}">
                  @csrf
                  @method("DELETE")
                  <button class="btn btn-sm btn-danger d-block btn-eliminar" data-value="{{$servicio->id}}" type="submit">Eliminar </button>
                </form>
              </td>
              
            </tr>
            @endforeach
          </tbody>
        </table>
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
        content: `Quiere eliminar la servicio #${servicio}`,
        type: 'red',
        typeAnimated: true,
        buttons: {
          eliminar:{
            btnClass: 'btn-red', 
            action: function () {
              $('.btn-eliminar').prop('disabled',true);
              $(`#form-${servicio}`).submit();
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