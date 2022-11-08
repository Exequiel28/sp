@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Informacion del Cliente</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">     
                                                                      
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                    
                        <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group"> 
                                   <label for="nombre">Nombre Completo</label>
                                   <br>
                                   <div class="infoc">
                                       {{ $clientes->nombre }} {{ $clientes->apellido }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="direccion">Direccion</label>
                                   <br>
                                   <div class="infoc">
                                   {{ $clientes->direccion}}
</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                   <label for="telefono">Telefono</label>
                                   <br>
                                   <div class="infoc">
                                   {{ $clientes->telefono }}
</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                   <label for="nrc">NRC</label>
                                   <br>
                                   <div class="infoc">
                                   {{ $clientes->nrc}}
</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                   <label for="nit">NIT</label>
                                   <br>
                                   <div class="infoc">
                                   {{ $clientes->nit}}
                                </div>
</div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                   <label for="dui">DUI</label>
                                    <br>
                                    <div class="infoc">
                                    {{ $clientes->dui}}
                                </div>
</div>
                            </div>
                            <a class="btn btn-warning" href="{{ route('clientes.index') }}">--Volver--</a>
                                                      
                        </div>
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
