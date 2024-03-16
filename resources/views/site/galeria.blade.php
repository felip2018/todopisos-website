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

        </div>
    </div>






    <section id="galeria" class="container">


        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-1.png')}}" alt="imagen 1">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-2.png')}}" alt="imagen 2">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-3.png')}}" alt="imagen 3">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-4.png')}}" alt="imagen 4">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-5.png')}}" alt="imagen 5">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-6.png')}}" alt="imagen 6">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-7.png')}}" alt="imagen 7">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-8.png')}}" alt="imagen 8">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src=" {{asset('assets/img/imagenes/piso-9.png')}}" alt="imagen 9">
            </div>
        </div>

    </section>



@endsection
