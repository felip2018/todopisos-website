@extends('templates.app')


@section('content')
    <style>
        .span-info {
            font-weight: bold;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Registrar factura
            </div>
            <div class="alert alert-info">
                En esta sección podrá realizar el registro una remisión de venta para el cliente seleccionado.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            Agregar producto
            <hr>
            <div class="row">
                <div class="col-12">
                    <label>Linea de producto</label>
                    <select class="form-control" id="productLineId" onchange="searchProducts()">
                        <option value="">-Seleccione</option>
                        @foreach ($productLines as $pl)
                            <option value="{{$pl->productLineId}}">{{$pl->name}}</option>
                         @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Producto</label>
                    <select class="form-control" id="productId">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Descripción</label>
                    <textarea class="form-control" rows="3" id="productDescription"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Cantidad</label>
                    <input class="form-control" type="number" id="quantity">
                </div>
                <div class="col-6">
                    <label>Valor unitario ($)</label>
                    <input class="form-control" type="number" id="price">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    <button class="btn btn-primary btn-block">
                        <i class="fa fa-plus"></i> Agregar producto
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            Remisión No. <span class="span-info">37</span>
            <hr>
            <label>Datos del cliente</label><br>
            <div id="datos-cliente">
                <p>
                    Nombre: {{$customerInfo->name}} {{$customerInfo->surname}}<br>
                    Identificación: {{$customerInfo->abbreviation}} {{$customerInfo->docNum}}<br>
                    Correo electrónico: {{$customerInfo->email}}<br>
                    Dirección: {{$customerInfo->address}} ({{$customerInfo->cityName}})
                </p>
            </div>
            <label>Productos</label><br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <th>No.</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Valor Unit</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody id="lista-productos">

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th id="total"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
