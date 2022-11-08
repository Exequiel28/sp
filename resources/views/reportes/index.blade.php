@extends('layouts.app')

@section('content')

{{-- Message --}}
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
            {{ session('message') }}
                </div>
            @endif
            
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reportes</h3>
        </div>
        

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">  
                            <div>
                                <h5 class="text-center">Reportes de Ordenes de Trabajos</h5><br>
                            </div>
                                <form action="{{route('reportes.index')}}" method="GET">
                                    @csrf
                                    <div class="row"> 
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="fecha1">Fecha de Inicio</label>
                                                <input type="date" id="fecha1" name="fecha1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="fecha2">Fecha de Final</label>
                                                <input type="date" id="fecha2" name="fecha2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                <button type="submit" class="btn btn-primary">Buscar</button>                        
                                        </div>
                                    </div>
                                </form>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <form action="{{ route('download-pdf1') }}" method="GET">
                                    <input name="fecha1" type="hidden" value="{{ $fecha1 }}">
                                    <input name="fecha2" type="hidden" value="{{ $fecha2 }}">
                                    <button type="submit" class="btn btn-success btn-sm">Exportar a PDF</button>
                                    </form>
                            </div>
                        
                    
                   
                    
                    <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    
                                    
                                    <th style="color:#fff;">No</th>
                                    <th style="color:#fff;">Producto</th>
                                    <th style="color:#fff;">Ancho</th>
                                    <th style="color:#fff;">Alto</th>
                                    <th style="color:#fff;">Fecha de Entrega</th>
                                    <th style="color:#fff;">Hora de Entrega</th>
                                    <th style="color:#fff;">Vendedor</th>

                                </thead>  
                                <tbody>
                                @foreach ($ordenes as $orden)
                                <tr>                           
                                
                                
                                <td>{{ $orden->id }}</td>
                                <td>{{ $orden->producto }}</td>
                                <td>{{ $orden->ancho }}</td>
                                <td>{{ $orden->alto }}</td>
                                <td>{{ $orden->fecha_entrega }}</td>
                                <td>{{ $orden->hora_entrega }}</td>
                                <td>{{ $orden->userventa }}</td>

                             </tr>

                                @endforeach
                                </tbody>               
                            </table>
                            
                            
                            
                    </div>
                    
                    </div>
                    </div>
                    </div>   
                    </div> 
                           
            
                    <div class="section-body">      
                        <div class="row">
                            <div class="col-lg-12">
                                  <div class="card">
                                  <div class="row">
              
          </div>
                                     <div class="card-body"> 
                                        <div>
                                           <h5 class="text-center">Reportes de Venta Total</h5><br>
                                        </div>
                    <form action="{{route('reportes.index')}}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha3">Fecha de Inicial</label>
                                   <input type="date" id="fecha3" name="fecha3" class="form-control">
                                </div>
                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha4">Fecha de Final</label>
                                   <input type="date" id="fecha4" name="fecha4" class="form-control">
                                </div>
                            </div>                            
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button> 
                    </form>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <form action="{{ route('download-pdf2') }}" method="GET">
                                    <input name="fecha3" type="hidden" value="{{ $fecha3 }}">
                                    <input name="fecha4" type="hidden" value="{{ $fecha4 }}">
                                    <button type="submit" class="btn btn-success btn-sm">Exportar a PDF</button>
                                    </form>
                            </div>
                    <br>
                    <div class="infoc col-md-4"> <a>Venta Total</a> $  {{ $ordenestotal }}  </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
                  
                    <div class="section-body">      
                        <div class="row">
                            <div class="col-lg-12">
                                  <div class="card">
                                     <div class="card-body">              
                <div>
                    <br><h5 class="text-center">Reportes de Productos Vendidos</h5>
                    </div>
                   
                <div class="row col-xs-12 col-sm-12 col-md-12">
                        <form action="{{route('reportes.index')}}" method="GET">
                        @csrf
                        <div class="row">
                           
                           
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha5">Fecha de Inicial</label>
                                   <input type="date" id="fecha5" name="fecha5" class="form-control">
                                </div>
                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha6">Fecha de Final</label>
                                   <input type="date" id="fecha6" name="fecha6" class="form-control">
                                </div>
                            </div>
                                                       
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button> 
                    </form>
                    <br>
        
                  
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">
                                    <tr>
                                        <td style="color:#fff;">Producto</td>
                                        <td style="color:#fff;">Venta</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($ordenesprod as $orden)
                                    <tr>
                                        <td>
                                        {{ $orden->producto }}
                                        </td>
                                        <td>
                                            {{ $orden->venta }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                             
                            </div>
                            <div class="col-xl-12 text-right">
                            <form action="{{ route('download-pdf') }}" method="GET">
                            <input name="fecha5" type="hidden" value="{{ $fecha5 }}">
                            <input name="fecha6" type="hidden" value="{{ $fecha6 }}">
                            
                            <button type="submit" class="btn btn-success btn-sm">Export to PDF</button> 

                            </form>
                            
                                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="section-body">      
                        <div class="row">
                            <div class="col-lg-12">
                                  <div class="card">
                                     <div class="card-body">              
                <div>
                    <br><h5 class="text-center">Reportes de Ventas por Usuario</h5>
                    </div>
                   
                <div class="row col-xs-12 col-sm-12 col-md-12">
                        <form action="{{route('reportes.index')}}" method="GET">
                        @csrf
                        <div class="row">
                           
                           
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha7">Fecha de Inicial</label>
                                   <input type="date" id="fecha7" name="fecha7" class="form-control">
                                </div>
                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha8">Fecha de Final</label>
                                   <input type="date" id="fecha8" name="fecha8" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="form-group">
                                   <label for="userventa">Usuario</label>
                                   <select name="userventa" class="form-select custom-select" aria-label="Default select example">
                                   @foreach($lista_users as $item)
                                        <option value="{{$item->name }}">{{$item->name}}</option>
                                   @endforeach
                                </select>
                                </div>
                            </div>                          
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button> 
                    </form>
                    <br>
        
                  
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">
                                    <tr>
                                        <td style="color:#fff;">Usuario</td>
                                        <td style="color:#fff;">Cantidad de Ordenes</td>
                                        <td style="color:#fff;">Total Vendido</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($ordenesuser as $orden)
                                    <tr>
                                        <td>
                                         {{ $orden->userventa }}
                                        </td>
                                        <td>
                                            {{ $orden->cantidad }}
                                        </td>
                                        <td>
                                           $ {{ $ordenestotaluser }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->
                                              
                            </div>
                            
                        </div>
                        <div class="col-xl-12 text-right">
                            
                            <div class="col-xl-12 text-right">
                            <form action="" method="GET">
                            <input name="fecha5" type="hidden" value="{{ $fecha5 }}">
                            <input name="fecha6" type="hidden" value="{{ $fecha6 }}">
                            
                            <button type="submit" class="btn btn-success btn-sm">Export to PDF</button> 

                            </form>
                                            
                            </div>
                    </div>
                </div>
            </div>
            </div>
            </div>

            </div> 


            
    
        

    </section>


        
@endsection




                    
                    
       
   

