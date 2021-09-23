@extends('templates.website')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Cotización
            </div>
            <div class="alert alert-info">
                En esta sección encontrará el listado de elementos a cotizar.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="itemsList">

        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <label>Datos del cliente</label>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/quotation.js')}}"></script>
    <script>
        renderQuotationList();
    </script>
	
@endsection