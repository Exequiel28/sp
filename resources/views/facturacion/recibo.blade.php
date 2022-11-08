@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Facturacion</h3>
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
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                            <br>
    
                            <div class="row">
                            <div class="col-lg-8">
                                <h2>Recibo Comercial</h2>
                            </div>

                            <div class="col-lg-4">
                            <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo.png') }}" width="250"
                                alt="Infyom Logo">
                            </div>

        
</div>
                            

                        <h6>Cliente: </h6>
                         <h5>{{ $pedido->clientes->nombre }} {{ $pedido->clientes->apellido }}</h5> 
                        <br>
<h6>DUI:</h6>
                        <h5>{{ $pedido->clientes->dui }}</h5>
<br>
<h6>Direccion:</h6>
                        <h5>{{ $pedido->clientes->direccion }}</h5>
                        <br>


                        <table class="table table-striped mt-2">
                                <thead style="background-color:#009bdb">                                                       
                                    
                                    
                                    <th style="color:#fff;">Cantidad</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">Precio Unitario</th>
                                    <th style="color:#fff;">Ventas Gravadas</th>

                                    
                                    

                                </thead>  
                                <tbody>
                                @foreach ($ordenes as $orden)
                                <tr>                           
                                
                                
                                <td>{{ $orden->copias }}</td>
                                <td>{{ $orden->producto }} de {{ $orden->ancho }} X {{ $orden->alto }}</td>
                                <td>$ {{ ($orden->total)/($orden->copias) }}</td>
                                <td><input type="number" step=".01" name="alto" class="form-control izquierda" value="{{ $orden->total }}">
                                    </td>

                            </tr>

                                @endforeach
                                </tbody>               
                            </table>
                            <div class="col-lg-12 izquierda">
                            <h5>Sumas: $ {{ $ordenestotal }}</h5>
                            <br>
                            
                             <h5>TOTAL: $ {{ $ordenestotal }}</h5> 
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>




        @endsection


