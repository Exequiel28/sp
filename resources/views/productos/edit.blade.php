@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Modificar Producto</h3>
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

                    
                        <form action="{{ route('productos.update',$productos->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="codigo">Codigo</label>
                                   <input type="text" name="codigo" class="form-control" value="{{ $productos->codigo }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="nombre">Nombre</label>
                                   <input type="text" name="nombre" class="form-control" value="{{ $productos->nombre }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="Descripcion">Descripcion</label>
                                   <input type="text" name="descripcion" class="form-control" value="{{ $productos->descripcion}} ">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="estado">Estado</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option selected>Seleccione...</option>
                                    <option value="1">Habilitado</option>
                                    <option value="2">Desabilitado</option>

                                </select>
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
