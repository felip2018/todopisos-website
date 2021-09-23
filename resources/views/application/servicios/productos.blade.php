@extends('templates.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Productos
            </div>
            <div class="alert alert-info">
                En esta sección podrá configurar los productos ofrecidos para el servicio seleccionado
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-12">
			<table class="table">
                <tr>
                    <td>Servicio</td>
                    <td>{{$servicio->name}}</td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td>{{$servicio->description}}</td>
                </tr>
            </table>
		</div>
    </div>
    <div class="row">
		<div class="col-12">
            <hr>
            <button class="btn btn-primary" onclick="productRegister({{$servicio->productLineId}})">
                <i class="fa fa-plus"></i> Registrar nuevo
            </button>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead class="thead-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Destacado</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php $idx = 1;?>
                    @foreach ($productos as $p)
                        <?php 
                            $color = ($p->status == "ACTIVO") ? "#10ac84" : "#ee5253";
                        ?>
                        <tr>
                            <td>{{$idx}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->description}}</td>
                            <td>{{$p->outstanding}}</td>
                            <td style="background-color: {{$color}}; color:#FFFFFF;">
                                {{$p->status}}
                            </td>
                            <td>
                                <a class="btn btn-primary" title="Editar" href="/app/servicios/productos/editar/{{$p->productId}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if ($p->status == "ACTIVO")
                                    <button class="btn btn-danger" title="INACTIVAR" onclick="productStatus({{$servicio->productLineId}},{{$p->productId}}, 'INACTIVO')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @else
                                    <button class="btn btn-success" title="ACTIVAR" onclick="productStatus({{$servicio->productLineId}},{{$p->productId}}, 'ACTIVO')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <?php $idx++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
	
@endsection