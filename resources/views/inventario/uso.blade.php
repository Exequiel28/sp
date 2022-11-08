@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inventario en Uso</h3>
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

                 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">    
                        

                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    
                                    <th style="color:#fff;">Codigo</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">Cantidad</th>
                                    <th style="color:#fff;">Porcentaje de uso</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($useinventarios as $useinventario)
                                
                                @if ($useinventario->estado == '1')
                                <tr>                           
                                
                                    <td>{{ $useinventario->cod }}</td>
                                    <td>{{ $useinventario->nombre }}</td>
                                    <td>{{ $useinventario->descripcion }}</td>
                                    <td>{{ $useinventario->cantidad }}</td>
                                    <td>
                                    @if ($useinventario->uso > '40')
                                        <div class="alert alert-success"> {{ $useinventario->uso }} Metros Restantes</div>
                                    @else
                                    @if ($useinventario->uso < '41' & $useinventario->uso > '20')  
                                    <div class="alert alert-warning"> {{ $useinventario->uso }} Metros Restantes</div>
                                    @else     
                                    <div class="alert alert-danger"> {{ $useinventario->uso }} Metros Restantes</div>      
            

                                    @endif
                                    @endif

                                   </td>
                                    <td>                                
                                       
                                    @can('editar-inventario')
                                            <a class="btn" href="{{ route('inventario.increment2',$useinventario->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                    @endcan                                                                            
                                    </td>
                                    
                                </tr>
                                
                                @endif

                                @endforeach
                                </tbody>     
                                          
                            </table>
                            
                            <!-- Centramos la paginacion a la derecha -->
                               
                                           
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