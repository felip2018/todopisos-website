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
                Registrar {{$type == "1" ? "remisión":"cotización"}}
            </div>
            <div class="alert alert-info">
                En esta sección podrá realizar el registro una {{$type == "1" ? "remisión":"cotización"}} para el cliente seleccionado.
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
                    <select class="form-control" lbl="Linea de producto" id="productLineId" onchange="searchProducts()">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Producto</label>
                    <select class="form-control" lbl="Producto" id="productId">
                        <option value="">-Seleccione</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Descripción</label>
                    <textarea class="form-control" rows="3" lbl="Descripción" id="productDescription"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Cantidad</label>
                    <input class="form-control" type="number" lbl="Cantidad" id="quantity">
                </div>
                <div class="col-6">
                    <label>Valor unitario ($)</label>
                    <input class="form-control" type="number" lbl="Valor unitario" id="price">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    <div id="add-product-alert"></div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary btn-block" onclick="addProduct()">
                        <i class="fa fa-plus"></i> Agregar producto
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <!--Remisión No. <span class="span-info">37</span>
            <hr>-->
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
                        <th></th>
                        <th>No.</th>
                        <th>Descripción</th>
                        <th>Valor Unit</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody id="lista-productos">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th id="total"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>Abono</label>
                    <input type="number" class="form-control" id="advancement" value="0">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Observaciones</label>
                    <?php $default_txt = "- Instalación:\n- Transporte:\n- Adicionales:"; ?>
                    <textarea class="form-control" id="observations" rows="4" style="text-align: left">{{$default_txt}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <button class="btn btn-primary btn-block">
                        <i class="fa fa-save"></i> Guardar documento
                    </button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <button class="btn btn-info btn-block">
                        <i class="fa fa-print"></i> Imprimir
                    </button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <button class="btn btn-warning btn-block">
                        <i class="fa fa-paper-plane"></i> Enviar por correo
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function(){
            searchProductLines();
            renderProductsFromStorage();
        });
    </script>
@endsection
