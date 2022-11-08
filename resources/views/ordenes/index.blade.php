@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ordenes</h3>
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

            @can('ver-ordenes')
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <a class="btn btn-warning" href="{{ route('ordenes.ordendis') }}">Ordenes de Diseño</a>                        
                    </div> 
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <a class="btn btn-success" href="{{ route('ordenes.ordenimp') }}">Ordenes de Impresion</a>                        
                    </div> 
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <a class="btn btn-info" href="{{ route('ordenes.ordenaca') }}">Ordenes de Acabado</a>                        
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
        
                       

                        <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    
                                    
                                    <th style="color:#fff;">No</th>
                                    <th style="color:#fff;">Producto</th>
                                    <th style="color:#fff;">Ancho</th>
                                    <th style="color:#fff;">Alto</th>
                                    <th style="color:#fff;">Copias</th>
                                    <th style="color:#fff;">Fecha de Entrega</th>
                                    <th style="color:#fff;">Hora de Entrega</th>
                                    <th style="color:#fff;">Vendedor</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Acciones </th>
                                </thead>  
                                <tbody>
                                @foreach ($ordenes as $orden)
                                <tr>                           
                                
                                
                                <td>{{ $orden->id }}</td>
                                <td>{{ $orden->producto }}</td>
                                <td>{{ $orden->ancho }}</td>
                                <td>{{ $orden->alto }}</td>
                                <td>{{ $orden->copias }}</td>
                                <td>{{ $orden->fecha_entrega }}</td>
                                <td>{{ $orden->hora_entrega }}</td>
                                <td>{{ $orden->userventa }}</td>

                                @if ($orden->estado == '1')
                            <td>
                                <a class="jsgrid-button btn btn-warning"
                                href="">
                                    Diseño 
                                </a>
                            </td>
                        @else
                            @if ($orden->estado == '2')
                            <td>
                                <a class="jsgrid-button btn btn-success"
                                href="">
                                    Impresion 
                                </a>
                            </td>
                            @else
                            <td>
                                <a class="jsgrid-button btn btn-info"
                                href="">
                                    acabado 
                                </a>
                            </td>
                            @endif
                        @endif
                                

                               
                                                                
                            
                                <td>                                
                                    
                                @can('ver-ordenes')
                                        <a href="{{ route('ordenes.show',$orden->id) }}" title="Ver Orden"><i class="viewcolor fas fa-eye"></i></a>
                                @endcan

                                @can('editar-ordenes')
                                            <a class="" href="{{ route('ordenes.edit',$orden->id) }}" title="Editar"><i class="btnp fas fa-pencil-alt"></i></a>
                                            
                                @endcan

                                @can('borrar-ordenes')
                                        
                                        {!! Form::open(['method' => 'DELETE','route' => ['ordenes.destroy', $orden->id],'style'=>'display:inline']) !!}
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
                            {!! $ordenes->links() !!} 
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