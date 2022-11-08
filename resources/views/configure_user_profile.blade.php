@extends('layouts.app')

@section('content')
<!--- Mensajes -->
@if ( session('updateClave') )
<div class="alert alert-success" role="alert">
  <strong>Felicitaciones </strong>
    {{ session('updateClave') }}
</div>

@endif


@if ( session('name') )
<div class="alert alert-success" role="alert">
  <strong>Felicitaciones </strong>
    {{ session('name') }}
</div>
@endif


@if ( session('claveIncorrecta') )
  <div class="alert alert-danger" role="alert">
    <strong>Lo siento!</strong>  {{ session('claveIncorrecta') }}
  </div>
@endif


@if ( session('clavemenor') )
<div class="alert alert-warning" role="alert">
  <strong>Lo siento !</strong>
    {{ session('clavemenor') }}
</div>
@endif


<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Actualizar mi datos</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                        <form action="{{route('changePassword')}}" method="POST" class="needs-validation" novalidate>
                                @csrf 

                                <div class="row">
                                    <div class="form-group mt-3">
                                        <label for="name">Nombre de Usuario</label>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>    
                                <div class="row">
                                <div class="form-group mt-3">
                                    <label for="password_actual">Clave Actual</label>
                                    <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required>
                                        @error('password_actual')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mt-3">
                                        <label for="new_password ">Nueva Clave</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mt-3">
                                        <label for="confirm_password">Confirmar nueva Clave</label>
                                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required>
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" id="formSubmit">Guardar Cambios</button>
                                        <a href="/home" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                         
                            
                             
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>




@endsection