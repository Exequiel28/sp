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
                                <h2>Comprobante de Credito Fiscal</h2>
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
<h6>NIT:</h6>
                        <h5>{{ $pedido->clientes->nit }}</h5>
<br>
<h6>NRC:</h6>
                        <h5>{{ $pedido->clientes->nrc }}</h5>
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
                                
                                
                                <td><p class="izquierda">{{ $orden->copias }}</p></td>
                                <td><p >{{ $orden->producto }} de {{ $orden->ancho }} X {{ $orden->alto }}</p></td>
                                <td><p class="izquierda">$ {{ number_format((($orden->total)/($orden->copias))/1.13,2) }}</p></td>
                                <td><p class="izquierda">{{ number_format(($orden->total)/1.13,2) }}</p> </td>

                            </tr>

                                @endforeach
                                </tbody>               
                            </table>
                            <div class="col-lg-12 izquierda">
                            <h5>Sumas: $ {{ number_format(($ordenestotal)/1.13, 2) }}</h5>
                            <br>
                            <h5>13% de IVA: $ {{ number_format((($ordenestotal)/1.13)*0.13, 2) }}</h5> 
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


