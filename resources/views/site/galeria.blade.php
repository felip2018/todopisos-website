

@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Galeria
            </div>
        </div>
    </div>
    <section id="galeria" class="container">
        <!--<div class="row">
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
        </div>-->
        <div class="row">
            @foreach($data as $img)
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <label>{{$img["name"]}}</label>
                    @if(strpos($img["url"], ".mp4"))
                        <video src="{{$img["url"]}}" style="width: 100%" controls="true"></video>
                    @else
                        <img src="{{$img["url"]}}" alt="{{$img["name"]}}">
                    @endif
                    <p>{{$img["description"]}}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
