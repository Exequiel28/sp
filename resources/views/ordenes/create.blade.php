@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Orden</h3>
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

                        {{-- Message --}}
            @if(session()->has('message'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
            {{ session('message') }}
                </div>
            @endif

                    <form action="{{route('ordenes.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="form-group">
                                   <label for="producto">Producto</label>
                                   <select name="producto" class="form-select custom-select" aria-label="Default select example">
                                   @foreach($lista_productos as $item)
                                        <option value="{{$item->nombre }}">{{$item->nombre}}</option>
                                   @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="copias">Copias</label>
                                   <input type="number" name="copias" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="unidadm">Unidad de Medida</label>
                                    <select class="form-select custom-select" aria-label="Default select example" id="unidadm" name="unidadm">
                                    
                                    <option selected disabled>Seleccione Unidad</option>
                                    <option value="1">Centimetros</option>
                                    <option value="2">Metros</option>
                                    <option value="3">Pulgadas</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="ancho">Ancho</label>
                                   <input type="number" step=".01" name="ancho" class="form-control">
                                </div>
                            </div>                            
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                   <label for="alto">Alto</label>
                                   <input type="number" step=".01" name="alto" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="fecha_entrega">Fecha de Entrega</label>
                                   <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="hora_entrega">Hora de Entrega</label>
                                   <input type="time" id="hora_entrega" name="hora_entrega" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="precio">Precio Unitario</label>
                                   <input type="number" step=".01" name="precio" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                   <label for="preciodis">Precio de Diseño</label>
                                   <input type="number" step=".01" name="preciodis" class="form-control">
                                   <input type="hidden" name="userventa" class="form-control" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                                   <input type="hidden" name="id_pedido" class="form-control" value="{{$pedidos->id}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="descripcion">Descripcion</label>
                                   <textarea type="text" id="descripcion" name="descripcion" class="form-control"></textarea>
                                </div>
                            </div>
                                                       
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button> 
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
           $('#datetimepicker').datetimepicker();
        });
    </script>   

<script type="text/javascript">
$("#datetime").datetimepicker({
    format: 'yyyy-mm-dd hh:ii'
});
</script>
    </section>
@endsection
