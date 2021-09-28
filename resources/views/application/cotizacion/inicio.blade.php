@extends('templates.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Cotizaciones
            </div>
            <div class="alert alert-info">
                En esta sección podrá observar las cotizaciones registradas desde el sitio web para ser atendidas.
            </div>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <thead class="thead-light">
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Documento</th>
                    <th>Fecha solicitud</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php $idx = 1;?>
                    @foreach ($quotations as $q)
                        <?php 
                            $color = ($q->status == "ATENDIDA") ? "#10ac84" : "#ee5253";
                        ?>
                        <tr>
                            <td>{{$idx}}</td>
                            <td>{{$q->fullname}}</td>
                            <td>{{$q->document}}</td>
                            <td>{{$q->date}}</td>
                            <th style="background-color: {{$color}}; color:#FFFFFF;">
                                {{$q->status}}
                            </th>
                            <td>
                                <button class="btn btn-primary" title="Ver" onclick="showQuotation({{$q->quotationId}})">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection