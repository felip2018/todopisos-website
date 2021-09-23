@extends('templates.website')

@section('content')
	<script src="{{asset('assets/js/clientes/core.js')}}"></script>
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Registrarse
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6">
            <p class="contact-form-text">
                Ingresa los datos solicitados para proceder con el registro.
            </p>
            <div class="col-12 form-container">
                <div class="row">
					<div class="col-xs-12 col-md-6">
		                <label>Tipo de identificación</label>
		                <select class="form-control" lbl="Tipo de identificación" id="documentTypeId">
		                	<option value="">-Seleccione</option>
							@foreach ($documents as $doc)
								<option value="{{$doc->documentTypeId}}">{{$doc->name}}</option>
							@endforeach
		                </select>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Número de identificación</label>
		                <input type="number" class="form-control" lbl="Número de identificacion" id="docNum"/>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Nombre</label>
		                <input type="text" class="form-control" lbl="Nombre" id="name"/>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Apellido</label>
		                <input type="text" class="form-control" lbl="Apellido" id="surname"/>
		            </div>
		            <div class="col-12">
		                <label>Correo electrónico</label>
		                <input type="text" class="form-control" lbl="Correo electrónico" id="email"/>
		            </div>
					<div class="col-xs-12 col-md-6">
		                <label>Departamento</label>
		                <select class="form-control" lbl="Departamento" id="dpmntId" onchange="searchCity(this.value)">
		                	<option value="">-Seleccione</option>
							@foreach ($departments as $dpto)
								<option value="{{$dpto->dpmntId}}">{{$dpto->name}}</option>
							@endforeach
		                </select>
		            </div>
		            <div class="col-xs-12 col-md-6">
		                <label>Ciudad</label>
		                <select class="form-control" lbl="Ciudad" id="cityId" disabled>
		                	<option value="">-Seleccione</option>
		                </select>
		            </div>
		            <div class="col-12">
		                <label>Dirección</label>
		                <input type="text" class="form-control" lbl="Dirección" id="address"/>
		            </div>
		            <div class="col-12">
		                <label>Teléfono</label>
		                <input type="text" class="form-control" lbl="Teléfono" id="phone"/>
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