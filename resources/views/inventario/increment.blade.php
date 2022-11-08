@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inventario</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('crear-inventario')
                        <a class="btn btn-warning" href="{{ route('inventario.create') }}">Nuevo</a>                        
                        @endcan
        
                
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">Cantidad</th>
                                    <th style="color:#fff;">Precio de Compra</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($inventarios as $inventario)
                                <tr>                           
                                    <td>{{ $inventario->id }}</td>
                                    <td>{{ $inventario->nombre }}</td>
                                    <td>{{ $inventario->descripcion }}</td>
                                    <td>{{ $inventario->cantidad }}</td>
                                    <td>$ {{ $inventario->precio }}</td>
                                    <td>                                
                                        @can('editar-inventario')
                                            <a class="btn btn-primary" href="{{ route('inventario.edit',$inventario->id) }}">Agregar</a>
                                        @endcan
                                        
                                        @can('editar-inventario')
                                            <a class="btn btn-info" href="{{ route('inventario.increment') }}">Descargar</a>
                                        @endcan
                                        
                                        
                                       
                                        @can('borrar-inventario')
                                            {!! Form::open(['method' => 'DELETE','route' => ['inventario.destroy', $inventario->id],'style'=>'display:inline formEliminar']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
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