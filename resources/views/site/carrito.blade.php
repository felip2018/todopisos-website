@extends('templates.website')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Cotización
            </div>
            <div class="alert alert-info">
                En esta sección encontrará el listado de elementos a cotizar. Inicia sesión en nuestro sistema para enviar la solicitud de cotización.
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div id="itemsList"></div>
            <hr>
            <button class="btn btn-success btn-block">
                Solicitar cotización
            </button>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/quotation.js')}}"></script>
    <script>
        renderQuotationListWeb();
    </script>
	
@endsection