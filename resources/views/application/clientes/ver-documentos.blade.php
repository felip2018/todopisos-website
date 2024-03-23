@extends('templates.app')


@section('content')
    <?php
    setlocale(LC_MONETARY, 'es_ES');
        ?>
    <style>
        .doc {
            background: #ffffff;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .doc:hover {
            border: 1px solid #333333;
            cursor: pointer;
        }
        .status-span {
            padding: 0px 5px 0px 5px;
            border-radius: 5px;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Ver historial
            </div>
            <div class="alert alert-info">
                En esta sección podrá observar el historial de documentos para el cliente seleccionado.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <label>Datos del cliente</label><br>
            <div id="datos-cliente">
                <p>
                    Nombre: {{$customerInfo->name}} {{$customerInfo->surname}}<br>
                    Identificación: {{$customerInfo->abbreviation}} {{$customerInfo->docNum}}<br>
                    Correo electrónico: {{$customerInfo->email}}<br>
                    Dirección: {{$customerInfo->address}} ({{$customerInfo->cityName}})
                </p>
            </div>
            <hr>
            <label>Lista de documentos</label>
            @foreach($documents as $doc)
                <div class="row doc" onclick="getDocumentInfo({{$doc["idDocument"]}})">
                    <div class="col-12">
                        <?php
                            $bg = $doc["type"] == "Remisión" ? "#48dbfb":"#feca57";
                            ?>
                        <p>
                            Fecha de creación: {{$doc["date"]}}<br>
                            Tipo: <span class="status-span" style="background-color: {{$bg}}">{{$doc["type"]}} No. {{$doc["number"]}}</span><br>
                            Total: {{number_format($doc["total"])}} COP
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div id="doc-header"></div>
            <hr>
            <div id="buttons-div"></div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Descripción</th>
                        <th>Valor Unit</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody id="lista-productos">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th>
                                <label id="total"></label>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Abono</th>
                            <th>
                                <label id="advancement"></label>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total a pagar</th>
                            <th>
                                <label id="total_pay"></label>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Observaciones</label>
                    <textarea class="form-control" id="observations" rows="4"></textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
