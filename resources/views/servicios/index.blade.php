@extends('layout')
@section('title','Listado de Servicios')
@section('content')
<div class="row justify-content-center mt-3">
  <div class="col-10">

  
    <div class="card shadow">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-5">
            <h2>Listado de Servicios</h2>
          </div>
          <div class="col-5">
            
            <form action="{{ url('servicios/') }}" method="GET">
            <div class="form-group">
              <div class="input-group input-group-sm">
              
                <input type="text" name="busqueda" id="busqueda" class="form-control" value="{{ $busqueda ?? '' }}"
                        placeholder="Descripcion..." aria-label="busqueda" aria-describedby="busqueda">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                <a class="btn btn-outline-secondary" href="{{ url('/servicios') }}">Limpiar busqueda</a>
                
                
              </div>
            </div>
            </form>
          </div>
          <div class="col-2 d-grid">
            <a href="{{ url('servicios/create') }}" class="btn btn-sm btn-success">Agregar servicio</a>
          </div>
        </div>
  
        @include('messages')

        @if(count($servicios) == 0 && $busqueda == '')
        <div class="row pt-3">
          <div class="col text-center">
            Aun no hay servicios cargados
          </div>
        </div>
        @elseif(count($servicios) == 0 && $busqueda != '')
        <div class="row pt-3">
          <div class="col text-center">
            No se encontraron servicios segun el criterio de busqueda
          </div>
        </div>
        @elseif(count($servicios) > 0)

        <table class="table">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 50%;">Descripcion</th>
              <th style="width: 10%; text-align: right;">Importe</th>
              <th style="width: 7%;"></th>
              <th style="width: 7%;"></th>
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
                <form action="{{ url('servicios/'.$servicio->id) }}" method="POST" id="form-{{ $servicio->id }}" class="d-grid">
                  @csrf
                  @method("DELETE")
                  <button class="btn btn-sm btn-danger d-block d-flex- btn-eliminar" data-value="{{$servicio->id}}" id="btn-eliminar-{{ $servicio->id }}" type="submit">Eliminar </button>
                </form>
              </td>
              
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="row">
          <div class="col">
          {{ ($busqueda) 
            ? $servicios->appends(['busqueda' => $busqueda])->links() 
            : $servicios->links() }}
          </div>
        </div>
        @endif
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
              $('#btn-eliminar-'+servicio).html('<i class="fa-solid fa-spinner fa-spin-pulse"></i>');
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