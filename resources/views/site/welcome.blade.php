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
        <div class="col-12">
            <div class="section-title">
                Nuestros productos destacados
            </div>
            <div>
                <div class="owl-carousel owl-theme mt-5">
                    @foreach ($destacados as $destacado)
                        <div class="item">
                            <b>{{$destacado->name}}</b>
                            <hr>
                            <img src="{{asset($destacado->img)}}" alt="{{$destacado->img}}">
                            <!--<hr>
                            <button class="btn btn-primary btn-block" onclick="addProductToQuotation({{$destacado->productId}},'{{$destacado->name}}','{{$destacado->img}}')">
                                <i class="fa fa-plus"></i> Agregar a cotización
                            </button>-->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @yield('productos')

@endsection
