@extends('templates.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Bienvenid@ has iniciado sesion como ADMINISTRADOR
            </div>
            <!--<div class="section-title">
                Clientes registrados
            </div>-->
            <div class="alert alert-info">
                En esta sección podrá observar el listado de clientes registrados en el sistema asi como realizar nuevos registros.
            </div>
        </div>
        <div class="col-xs-12 m-2">
            <a href="/app/clientes/registrar" class="btn btn-primary">
                <i class="fa fa-plus"></i> Registrar nuevo
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <label for="document-filter">Filtrar por documento</label>
            <input type="number" class="form-control" min="0" id="document-filter" onkeyup="filterCustomersByDocument(this.value)">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody id="lista-clientes">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function(){
            getAllCustomers();
        })
    </script>
@endsection
