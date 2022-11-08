@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inventario</h3>
        </div>
        <div class="section-body">
        {{-- Message --}}
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
            {{ session('message') }}
                </div>
            @endif

                 @can('ver-inventario')
                 <form action="{{route('inventario.index')}}" method="get"> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <input type="text" class="form-control" name="texto" value="{{$texto}}">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                    
                                   <input type="submit" name="cantidad" class="btn btn-info" value="Buscar">
                                </div>
                            </div>                            
                        </div>
                 </form>
                 @endcan
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('crear-inventario')
                        <a class="btn btn-warning" href="{{ route('inventario.create') }}">Nuevo</a>                        
                        @endcan
        
                        

                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    
                                    <th style="color:#fff;">Codigo</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">Cantidad</th>
                                    <th style="color:#fff;">Precio de Compra</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($inventarios as $inventario)
                                <tr>                           
                                    
                                    <td>{{ $inventario->cod }}</td>
                                    <td>{{ $inventario->nombre }}</td>
                                    <td>{{ $inventario->descripcion }}</td>
                                    <td>{{ $inventario->cantidad }}</td>
                                    <td>$ {{ $inventario->precio }}</td>
                                    <td>                                
                                        @can('admin')
                                            <a class="" href="{{ route('inventario.edit',$inventario->id) }}" title="Editar"><i class="btnp fas fa-pencil-alt"></i></a>
                                            
                                        @endcan
                                        
                                        @can('editar-inventario')
                                            <a class="" href="{{ route('inventario.increment',$inventario->id) }}" title="Agregar"><i class="btnv fas fa-plus"></i></a>
                                        @endcan

                                        @can('editar-inventario')
                                            <a class="" href="{{ route('inventario.increment1',$inventario->id) }}" title="Descargar"><i class="btnr fas fa-minus"></i></a>
                                        @endcan
                                        
                                        @can('editar-inventario')
                                            <a class="" href="{{ route('inventario.agregar',$inventario->id) }}" title="Usar Material"><i class="icolor fas fa-scroll"></i></a>
                                        @endcan
                                        
                                       
                                        @can('borrar-inventario')
                                        
                                            {!! Form::open(['method' => 'DELETE','route' => ['inventario.destroy', $inventario->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-sm btn-danger']) !!}
                                                
                                            {!! Form::close() !!}
                                            
                                        @endcan    
                                        
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $inventarios->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
@endsection

@section('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminar')=='OK')
<script>
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success')
</script>
@endif

<script>
   
   $('.formEliminar').submit(function(e){
       e.preventDefault();

       Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      this.submit();
    /*  */
    )
  }
}) 
   });

   
  
</script>



@endsection