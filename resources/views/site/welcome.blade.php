@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Bienvenid@
            </div>
        </div>
        <div class="col-xs-12 col-md-8">
            <div class="row">
                <div class="col-12">
                    <img src="{{asset('assets/img/inicio.jpg')}}" alt="Imagen" width="100%">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="resume">
                        <h4 class="resume_title">Ofrecemos calidad</h4>
                        <p class="resume_text">
                            Contamos con una variedad de diseños para todos los gustos.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="lady">
                        <img src="{{asset('assets/img/miss.jpg')}}" alt="Lady" width="100%">
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    @yield('productos')

@endsection
