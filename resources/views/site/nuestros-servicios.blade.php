@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Nuestros servicios
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/linea_pisos.jpg')}}" class="card-img-top" alt="linea_pisos">
                    <div class="card-body">
                        <h5 class="card-title">Línea de pisos</h5>
                        <p class="card-text">Contamos con una selección de pisos en madera a su gusto.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/linea_cortinas.jpg')}}" class="card-img-top" alt="linea_cortinas">
                    <div class="card-body">
                        <h5 class="card-title">Línea de cortinas</h5>
                        <p class="card-text">Nuestros diseños le dan un toque especial a sus espacio.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/linea_escaleras.jpg')}}" class="card-img-top" alt="linea_escaleras">
                    <div class="card-body">
                        <h5 class="card-title">Línea de escaleras</h5>
                        <p class="card-text">Elije el diseño que más elegante que resalte tu hogar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection