<style>
    body {
        font-family: "Helvetica Neue", sans-serif;
    }
    .col-center {
        text-align: center;
    }
    .container {
        width:800px;
        margin:auto;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px #CCCCCC;
        font-family: "Helvetica Neue", sans-serif;
    }
    .title {
        text-align: center;
    }
    .status-span {
        padding: 0px 5px 0px 5px;
        border-radius: 5px;
    }
    .form-control {
        width: 100%;
    }
</style>
<?php
    $customerInfo = $data["user"];
    $bg = $data["type"] == "Remisión" ? "#48dbfb":"#feca57";
?>
<div class="container">
    <div class="title" style="text-align: center">
        <img style="width: 400px;height: auto;" src="https://todopisosycortinas.com/assets/img/logo_todopisos_alt.png" alt="logo_todopisos_alt.png">
    </div>
    <div class="header">
        <p>
            <span class="status-span" style="background-color: {{$bg}};padding: 5px; border-radius: 5px;">{{$data["type"]}} No. {{$data["number"]}}</span><br>
            Fecha de creación: {{$data["date"]}}
        </p>

        <label>Datos del cliente</label><br>
        <div id="datos-cliente">
            <p>
                Nombre: {{$customerInfo->name}} {{$customerInfo->surname}}<br>
                Identificación: {{$customerInfo->abbreviation}} {{$customerInfo->docNum}}<br>
                Correo electrónico: {{$customerInfo->email}}<br>
                Dirección: {{$customerInfo->address}}
            </p>
        </div>
        <hr>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-striped" style="width: 100%;" border="1">
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
                @foreach($data["productsList"] as $p)
                    <tr>
                        <td>{{1}}</td>
                        <td>
                            {{$p["product"]["name"]}}<br>
                            [{{$p["description"]}}]
                        </td>
                        <td class="col-center">{{number_format($p->unitPrice)}} COP</td>
                        <td class="col-center">{{$p->quantity}}</td>
                        <td class="col-center">{{number_format($p->totalPrice)}} COP</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total</th>
                    <th>
                        <label>{{number_format($data["total"])}} COP</label>
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Abono</th>
                    <th>
                        <label>{{number_format($data["advancement"])}} COP</label>
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total a pagar</th>
                    <th>
                        <label>{{number_format($data["balance"])}} COP</label>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
                <label>Observaciones</label><br>
                <textarea style="width: 100%" rows="4" disabled="true">{{$data["observations"]}}
                </textarea>
            </div>
        </div>
    </div>
</div>
<script>
    // window.print();
</script>
