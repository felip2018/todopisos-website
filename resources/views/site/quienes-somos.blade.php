@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Quienes somos
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="resume">
                        <p class="resume_text">
                            <b>Todo en Pisos & Cortinas</b> es una empresa instaurada en el mercado desde hace 9 años, nos caracterizamos por nuestro cumplimiento y brindar un excelente servicio para nuestros clientes, preocupandonos por cada detalle en nuestras obras y poder garantizar un trabajo perfecto.
                        </p>
                        <p class="resume_text">
                            Nuestros productos importados son de excelente calidad y por lo tanto damos total garantia de ellos ofreciendo a nuestros clientes la tranquilidad de adquirir cualquiera de nuestros pisos y cortinas.
                        </p>
                        <p class="resume_text">
                            Tambien contamos con excelentes instaladores los cuales trabajan con nosotros desde el momento de apertura de la empresa, garantizandoles una perfecta mano de obra con total responsabilidad al momento de la entrega del trabajo.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="about-img">
                        <img src="{{asset('assets/img/pisos-1.jpg')}}" alt="Pisos_1" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row section">
        <div class="col-12">
            <div class="section-secondary-title">
                Nuestro equipo
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">Isabel</h5>
                        <p class="card-text">Diseñadora</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">Juan</h5>
                        <p class="card-text">Instalador</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">Carlos</h5>
                        <p class="card-text">Ventas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">María</h5>
                        <p class="card-text">Comercial</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection