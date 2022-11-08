@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ordenes de Diseño</h3>
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

                                @can('ver-diseño')
                                <a href="{{ route('ordenes.camestado1',$orden->id) }}"><i class="fas fa-sign-out-alt"></i></a>
@endcan

                                @can('admin')
                                            <a class="" href="{{ route('ordenes.edit',$orden->id) }}" title="Editar"><i class="btnp fas fa-pencil-alt"></i></a>
                                            
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