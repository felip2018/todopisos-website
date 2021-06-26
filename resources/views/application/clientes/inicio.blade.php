@extends('templates.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Clientes
            </div>
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
    <script>
        jQuery(document).ready(function(){
            getAllCustomers();
        })
    </script>
@endsection