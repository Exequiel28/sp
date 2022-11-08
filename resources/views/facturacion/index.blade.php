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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
@endsection

