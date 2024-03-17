@extends('templates.app')


@section('content')
    <style>
        .img-container {
            border:1px solid #cccccc;
            border-radius: 5px;
            padding: 5px;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Galería de imágenes
            </div>
            <div class="alert alert-info">
                En esta sección podrá realizar la configuración de imágenes de la galería.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            Registrar imagen
            <hr>
            <div class="row">
                <div class="col-12">
                    <label>Nombre de imagen</label>
                    <input type="text" id="name" class="form-control" lbl="Nombre de imagen">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Descripción</label>
                    <textarea class="form-control" id="description" rows="3" lbl="Descripción"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Archivo</label>
                    <input type="file" id="file" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    <div id="add-image-alert"></div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary btn-block" accept="image/png, image/gif, image/jpeg, image/jpg" onclick="uploadImage()">
                        <i class="fa fa-upload"></i> Cargar imagen
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            Imagenes cargadas
            <hr>
            <div class="row">
                @foreach($data as $img)
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-9">
                                    <label>Esta es un titulo de prueba para validar la capacidad del contenedor</label>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-danger btn-block" title="Eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <img src="../{{$img["url"]}}" style="width: 100%"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p>{{$img["description"]}}</p>
                                    <label>Estado: </label> {{$img["status"]}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
