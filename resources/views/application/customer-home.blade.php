@extends('templates.app')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Bienvenid@ has iniciado sesion como CLIENTE
            </div>
            <div class="alert alert-info">
                Podrás observar si tienes elementos agregados a la lista de cotización, puedes agregar comentarios sobre cada producto para realizar la solicitud de cotización.
            </div>
        </div>
        <div class="col-12">
            <form class="row" id="quotationForm">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div id="itemsList"></div>
                    <div class="alerta"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div style="text-align: center">
                        <b>Datos del cliente</b>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" disabled="true">
                        </div>
                        <div class="col-12">
                            <label>Apellido</label>
                            <input type="text" class="form-control" name="surname" id="surname" disabled="true">
                        </div>
                        <div class="col-12">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" name="phone" id="phone" disabled="true">
                        </div>
                        <div class="col-12">
                            <label>Correo electrónico</label>
                            <input type="text" class="form-control" name="email" id="email" disabled="true">
                        </div>
                        <div class="col-12">
                            <label>Observaciones</label>
                            <textarea class="form-control" id="customerObservations" rows="4" placeholder="Agregar observaciones generales (opcional)"></textarea>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12" id="alerta">

                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-block" onclick="quotationRequest()">
                                <i class="fas fa-paper-plane"></i> Solicitar cotización
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/session-core.js')}}"></script>
    <script src="{{ asset('assets/js/quotation.js')}}"></script>
    <script>
        renderQuotationListApp();
        let customer = getCustomerData();
        jQuery('#name').val(customer['name']);
        jQuery('#surname').val(customer['surname']);
        jQuery('#phone').val(customer['phone']);
        jQuery('#email').val(customer['email']);
    </script>

@endsection
