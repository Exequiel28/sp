@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usar Material de Inventario</h3>
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
                            @if(session()->has('message'))
                                <div class="alert alert-danger">
                                    {{ session('message') }}
                                </div>
                            @endif
                    
                        <form action="{{ route('inventario.usando',$inventario->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="nombre">Nombre</label>
                                   <input type="text" name="nombre" class="form-control" value="{{ $inventario->nombre }}">
                                   <input type="hidden" name="cod" class="form-control" value="{{ $inventario->cod }}">
                                   <input type="hidden" name="descripcion" class="form-control" value="{{ $inventario->descripcion }}">
                                   <input type="hidden" name="precio" class="form-control" value="{{ $inventario->precio }}">
                                   <input type="hidden" name="estado" class="form-control" value="1">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="uso">Cuantos Metros tiene el rollo</label>
                                   <input type="number" name="uso" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="cantidad">Cantidad</label>
                                   <input type="number" name="cantidad" class="form-control">
                                   <input name="cantidad2" type="hidden" value="{{ $inventario->cantidad }}">
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Guardar</button>                            
                        </div>
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
