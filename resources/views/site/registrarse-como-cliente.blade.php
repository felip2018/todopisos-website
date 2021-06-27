@extends('templates.website')

@section('content')
	<script src="{{asset('assets/js/clientes/core.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Registrar cliente
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6">
            <p class="contact-form-text">
                Ingresa los datos del cliente para proceder con el registro.
            </p>
            <div class="col-12 form-container">
                <div class="row">
		            <div class="col-xs-12 col-md-6">
		                <label>Tipo de identificación</label>
		                <select class="form-control" lbl="Tipo de identificación" id="tipo_identi">
		                	<option value="">-Seleccione</option>
		                	<option value="CC">Cédula de ciudadanía</option>
		                	<option value="CE">Cédula de extranjería</option>
		                	<option value="PAS">Pasaporte</option>
		                	<option value="NIT">NIT</option>
		                </select>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Número de identificación</label>
		                <input type="number" class="form-control" lbl="Número de identificacion" id="num_identi"/>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Primer nombre</label>
		                <input type="text" class="form-control" lbl="Primer nombre" id="nombre"/>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Segundo nombre</label>
		                <input type="text" class="form-control" lbl="Segundo nombre" id="nombre2"/>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Primer apellido</label>
		                <input type="text" class="form-control" lbl="Primer apellido" id="apellido"/>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Segundo apellido</label>
		                <input type="text" class="form-control" lbl="Segundo apellido" id="apellido2"/>
		            </div>
		            <div class="col-12">
		                <label>Correo electrónico</label>
		                <input type="text" class="form-control" lbl="Correo electrónico" id="email"/>
		            </div>
		            <div class="col-12">
		                <label>Dirección</label>
		                <input type="text" class="form-control" lbl="Dirección" id="direccion"/>
		            </div>
		            <div class="col-12">
		                <label>Teléfono</label>
		                <input type="text" class="form-control" lbl="Teléfono" id="telefono"/>
		            </div>
		            <div class="col-12">
		                <hr>
		            </div>
		            <div class="col-12 alerta">
		            </div>
		            <div class="col-12">
		            	<button class="btn btn-primary btn-block" onclick="saveCustomer()">
		            		<i class="fa fa-save"></i> Guardar
		            	</button>
		            </div>
		        </div>
            </div>
        </div>
    </div>
@endsection