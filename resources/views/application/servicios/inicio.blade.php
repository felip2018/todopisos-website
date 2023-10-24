@extends('templates.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Servicios
            </div>
            <div class="alert alert-info">
                En esta sección podrá configurar los servicios de su negocio y que serán visualizados en el sitio web.
            </div>
        </div>
        <div class="col-xs-12 m-2">
            <a href="/app/servicios/registrar" class="btn btn-primary">
                <i class="fa fa-plus"></i> Registrar nuevo
            </a>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $service)
                                <?php
                                    $color = ($service->status == "ACTIVO") ? "#10ac84" : "#ee5253";
                                ?>
                                <tr>
                                    <td>{{$service->productLineId}}</td>
                                    <td>
                                        <img src="{{asset($service->img)}}" class="card-img-top" alt="{{$service->img}}" style="width:100px;heigth:100px;">
                                    </td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->description}}</td>
                                    <th style="background-color: {{$color}}; color:#FFFFFF;">
                                        {{$service->status}}
                                    </th>
                                    <td>
                                        <a class="btn btn-primary" title="Editar" href="/app/servicios/editar/{{$service->productLineId}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-primary" title="Productos" href="/app/servicios/productos/{{$service->productLineId}}">
                                            <i class="fas fa-list"></i>
                                        </a>
                                        @if ($service->status == "ACTIVO")
                                            <button class="btn btn-danger" title="INACTIVAR" onclick="serviceStatus({{$service->productLineId}}, 'INACTIVO')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @else
                                            <button class="btn btn-success" title="ACTIVAR" onclick="serviceStatus({{$service->productLineId}}, 'ACTIVO')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
