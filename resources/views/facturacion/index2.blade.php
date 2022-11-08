@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Facturar Pedido de {{ $pedido->clientes->nombre }}</h3>
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
                            <div class="row">
                                
                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-pedido order-card">
                                            <div class="card-block">
                                                <h4 class="text-right"><i class="fas fa-tasks f-left"></i><span>Recibo</span></h4>
                                                <p class="m-b-0 text-right"><a href="{{ route('facturacion.recibo',$pedido->id) }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h4 class="text-right"><i class="fas fa-tasks f-left"></i><span>Factura</span></h4>
                                                <p class="m-b-0 text-right"><a href="{{ route('facturacion.factura',$pedido->id) }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h4 class="text-right"><i class="fas fa-tasks f-left"></i><span>Credito Fiscal</span></h4>
                                                <p class="m-b-0 text-right"><a href="{{ route('facturacion.cfiscal',$pedido->id) }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
</div>    
                            
                        </div>
                    </div>
                </div>
            
            
        </section>
@endsection

