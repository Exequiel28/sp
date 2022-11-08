    @extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Informacion de la Orden</h3>
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
                            
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="form-group"> 
                                   <label for="producto">Producto</label>
                                   <br>
                                   <div class="infoc">
                                       {{ $ordenes->producto }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="copias">Copias</label>
                                   <div class="infoc">
                                   {{ $ordenes->copias }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="ancho">Ancho</label>
                                   <div class="infoc">
                                   {{ $ordenes->ancho }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="alto">Alto</label>
                                   <div class=" infoc">
                                   {{ $ordenes->alto }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="fecha_entrega">Fecha de Entrega</label>
                                   
                                   <div class="infoc">
                                   {{ $ordenes->fecha_entrega }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="hora_entrega">Hora de Entrega</label>
                                   
                                   <div class="infoc">
                                   {{ $ordenes->hora_entrega }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="userventa">Diseñador</label>
                                   <div class="infoc">
                                   {{ $ordenes->userventa }}
</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="nit">Descripcion</label>
                                   <div class="infoc">
                                   {{ $ordenes->descripcion }}
                                </div>
                            </div>
                            </div>
</div>
                            </div>
                            <a class="btn btn-warning" href="{{ URL::previous() }}">--Volver--</a>
                                                      
                        </div>
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
