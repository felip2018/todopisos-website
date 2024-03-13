<link rel="stylesheet" href="galeria.css">

@extends('templates.website')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Galeria
            </div>
            <div class="alert alert-info">
                Galería de imágenes
            </div>
            <!---->
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="border:1px solid green">
            <div class="gallery">
                <div class="clipped-border">
                    <img src="{{asset('assets/img/Galeria/pisos-1.png')}}" alt="Imagen">
                </div>
                <div class="clipped-border">
                    <img src="{{asset('assets/img/Galeria/pisos-2.png')}}" alt="Imagen">
                </div>
                <div class="clipped-border">
                    <img src="{{asset('assets/img/Galeria/pisos-3.png')}}" alt="Imagen">
                </div>
                  <div class="clipped-border">
                    <img src="{{asset('assets/img/Galeria/pisos-4.png')}}" alt="Imagen">
                </div>
                  <div class="clipped-border">
                    <img src="{{asset('assets/img/Galeria/pisos-5.png')}}" alt="Imagen">
                </div>
                <div class = "shadow"></div>
            </div>
        </div>
    </div>

@endsection
