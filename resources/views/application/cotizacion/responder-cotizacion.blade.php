@extends('templates.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Detalle de cotización
            </div>
            <div class="alert alert-info">
                En esta sección podrá observar las cotizaciones registradas desde el sitio web para ser atendidas.
            </div>
        </div>
        <div class="col-12">
            <b>Información del cliente</b>
            <table class="table">
                <tr>
                    <td>Nombre </td>
                    <td>{{$data["quotation"]->fullname}}</td>
                </tr>
                <tr>
                    <td>Documento </td>
                    <td>{{$data["quotation"]->document}}</td>
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td>{{$data["quotation"]->phone}}</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td>{{$data["quotation"]->address}}</td>
                </tr>
            </table>
        </div>
        <div class="col-12">
            <b>Detalle de la solicitud</b>
            <form id="quotationResponseForm">
                <table class="table table-striped">
                    <thead>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Valor unitario</th>
                        <th>Valor total</th>
                    </thead>
                    <tbody>
                        <?php $idx = 0;?>
                        @foreach ($data["detail"] as $d)
                            <?php 
                                $comment = ($d->productComment) ? $d->productComment : 'Sin descripción adicional';
                            ?>
                            <tr>
                                <td>{{$d->productName}}[{{$comment}}]</td>
                                <td>
                                    <input type="number" class="form-control" min="1" name="product[{{$idx}}][quantity]" value="{{$d->quantity}}" id="quantity_{{$idx}}"/>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min="1" name="product[{{$idx}}][unitPrice]" onblur="setTotalPrice({{$idx}})" id="unitPrice_{{$idx}}"/>
                                </td>
                                <td>
                                    <input type="text" class="form-control totalPrice" min="1" name="product[{{$idx}}][totalPrice]" disabled id="totalPrice_{{$idx}}" value="0"/>
                                </td>
                            </tr>
                            <?php $idx++;?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th>
                            <input id="totalQuotation" type="text" class="form-control" min="1" disabled/>
                        </th>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>

@endsection