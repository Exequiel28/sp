@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pedidos</h3>
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

            @can('ver-pedidos')
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <a class="btn btn-warning" href="{{ route('pedidos.pendientes') }}">Pedidos Pendientes</a>                        
                    </div> 
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <a class="btn btn-success" href="{{ route('pedidos.terminados') }}">Pedidos Terminados</a>                        
                    </div> 
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <a class="btn btn-info" href="{{ route('pedidos.entregados') }}">Pedidos Entregados</a>                        
                    </div> 
                </div> 
            </div> 

           
        @endcan

            <form  method="get"> 
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="texto" placeholder="Buscar">
                        <button class="btn btn-outline-primary" type="submit" id="texto">Buscar</button>
                    </div>
                 </form>
            
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('crear-pedidos')
                        <a class="btn btn-warning" href="">Nuevo</a>                        
                        @endcan

                        
                        

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
                                    @if ($pedido->estado == '1')
                                <td>
                                    <a class="jsgrid-button btn btn-warning"
                                    href="">
                                        En Proceso 
                                    </a>
                                </td>
                            @else
                                @if ($pedido->estado == '2')
                                <td>
                                    <a class="jsgrid-button btn btn-success"
                                    href="">
                                        Terminado 
                                    </a>
                                </td>
                                @else
                                <td>
                                    <a class="jsgrid-button btn btn-info"
                                    href="">
                                        Entregado 
                                    </a>
                                </td>
                                @endif
                            @endif
                                    

                                   
                                                                    
                                
                                    <td>                                
                                        
                                    @can('ver-pedidos')
                                            
                                            <a href="{{ route('pedidos.show',$pedido->id) }}" title="Ver Informacion"><i class="viewcolor fas fa-eye"></i></a>
                                            
                                    @endcan
                                    
                                    
                                    @can('editar-pedidos')
                                    @if ($pedido->estado == '2')      
                                    <a href="{{ route('pedidos.cestado',$pedido->id) }}" title=""><i class="viewcolor fas fa-sign-out-alt"></i></a>
                                    @endif
                                    @endcan

                                    @can('editar-facturacion')
                                            
                                            <a href="{{ route('facturacion.index2',$pedido->id) }}" title="Facturar"><i class="viewcolor fas fa-file-alt"></i></a>
                                            
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
                            {!! $pedidos->appends(['texto'=>$texto]) !!} 
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