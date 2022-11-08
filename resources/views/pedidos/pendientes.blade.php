@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pedidos Pendientes</h3>
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
                                    
                                    
                                    <th style="color:#fff;">No</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($pedidos as $pedido)
                               
                                
                                <tr>                           
                                
                                
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->clientes->nombre }}</td>
                                    <td>{{ $pedido->descripcion }}</td>
                                    <td>
                                        <a class="jsgrid-button btn btn-warning"
                                            href="">
                                            En Proceso 
                                        </a>
                                    </td>
                        
                                
        
                                    

                                   
                                                                    
                                
                                    <td>                                
                                        
                                    @can('ver-pedidos')
                                            
                                            <a href="{{ route('pedidos.show',$pedido->id) }}" title="Ver Pedido"><i class="viewcolor fas fa-eye"></i></a>
                                            
                                        @endcan
                                    
                                        @can('borrar-pedidos')
                                        
                                        {!! Form::open(['method' => 'DELETE','route' => ['pedidos.destroy', $pedido->id],'style'=>'display:inline']) !!}
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
                            {!! $pedidos->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

@endsection

@section('js')


@endsection