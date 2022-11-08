@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Clientes</h3>
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

                 @can('ver-clientes')
                 <form action="{{route('clientes.index')}}" method="get"> 
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
        
                        @can('crear-clientes')
                        <a class="btn btn-warning" href="{{ route('clientes.create') }}">Nuevo</a>                        
                        @endcan
       
                        

                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    
                                    
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Direccion</th>
                                    <th style="color:#fff;">Telefono</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>                           
                                    
                                    <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>                                
                                        
                                    @can('crear-pedidos')
                                            
                                            <a class="" href="{{ route('pedidos.agregar',$cliente->id) }}"><i class="fas fa-shopping-cart"></i></a>
                                    @endcan
                                   
                                    @can('editar-clientes')
                                            
                                            <a class="" href="{{ route('clientes.edit',$cliente->id) }}"><i class="btnp fas fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('ver-clientes')
                                            
                                            <a href="{{ route('clientes.show',$cliente->id) }}"><i class=" icolor fas fa-eye"></i></a>
                                    @endcan
                                    
                                    @can('borrar-clientes')
                                        
                                        {!! Form::open(['method' => 'DELETE','route' => ['clientes.destroy', $cliente->id],'style'=>'display:inline']) !!}
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
                                {!! $clientes->links() !!} 
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