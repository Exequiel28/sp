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
            <h3 class="page__heading">Inicio</h3>
        </div>
        <div class="section-body">
        @can('ver-diseño')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div>
                    <br><h5 class="text-center">Sección de Pedidos</h5>
                    </div>
                        <div class="card-body">                       
                            <div class="row">
                                
                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-pedido order-card">
                                            <div class="card-block">
                                                <h5>Total de Pedidos</h5>   
                                                @endcan                                            
                                                @php
                                                 use App\Models\Pedido;
                                                $cant_pedido = Pedido::count();                                                
                                                @endphp
                                                @can('ver-diseño')
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$cant_pedido}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/pedidos" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h5>Pedidos Pendientes</h5>                                               
                                                
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$countpen}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('pedidos.pendientes') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Pedidos Terminados</h5>                                               
                                                
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$countter}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('pedidos.terminados') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-3">
                                        <div class="card bg-c-black order-card">
                                            <div class="card-block">
                                                <h5>Pedidos Entregados</h5>                                               
                                                
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$countent}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('pedidos.entregados') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div>
                    <br><h5 class="text-center">Sección de Ordenes</h5>
                    </div>
                        <div class="card-body">                       
                            
                                <div class="row">

                                     <div class="col-md-12 col-xl-4">
                                        <div class="card bg-c-pedido order-card">
                                            <div class="card-block">
                                                <h5>Ordenes en Diseño</h5>                                               
                                                
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$countdis}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('ordenes.ordendis') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h5>Ordenes en Impresion</h5>                                               
                                                
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$countimp}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('ordenes.ordenimp') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Ordenes en Acabado</h5>                                               
                                                
                                                <h2 class="text-right"><i class="fas fa-shopping-cart f-left"></i><span>{{$countaca}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('ordenes.ordenaca') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                       
                            
                                <div class="row">
                                

                                @can('admin')
                                    <div class="col-md-4 col-xl-4">
                                    
                                    <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                            <h5>Usuarios</h5>         
                                @endcan                                      
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                @can('admin')
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                 
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                            <h5>Roles</h5>   
                                @endcan                                             
                                                @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();                                                
                                                @endphp

                                @can('admin')                
                                                <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>                                                                
                                @endcan    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Inventario</h5>                                               
                                                @php
                                                 use App\Models\Inventario;
                                                $cant_inventario = Inventario::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-archive f-left"></i><span>{{$cant_inventario}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/inventario" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card">
                                            <div class="card-block">
                                                <h5>Clientes</h5>                                               
                                                @php
                                                 use App\Models\Cliente;
                                                $cant_cliente = Cliente::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-archive f-left"></i><span>{{$cant_cliente}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/clientes" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                                <h5>Productos</h5>                                               
                                                @php
                                                 use App\Models\Producto;
                                                $cant_producto = Producto::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-archive f-left"></i><span>{{$cant_producto}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/productos" class="text-white">Ver más</a></p>
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

