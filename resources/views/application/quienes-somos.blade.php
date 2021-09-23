@extends('templates.app')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Quienes somos
            </div>
            <div class="alert alert-info">
                En esta sección podrá configurar la información que se visualiza en la página "Quienes somos"
            </div>
        </div>
        <div class="col-12">
            <form id="aboutUsForm" class="row justify-content-center">
                <div class="col-xs-12 col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <label>Descripción</label>
                            <textarea type="text" class="form-control" lbl="Descripción" id="description" name="description" rows="7">{{$data->description}}</textarea>
                        </div>
                        <div class="col-12">
                            <label>Seleccionar imagen</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <label>Actual</label>
                                    <img src="{{asset($data->image)}}" alt="{{$data->image}}" width="100%">
                                </div>
                                <div class="col-xs-12 col-md-6">    
                                    <label>Nueva</label>
                                    <img src="{{asset('assets/img/no-image.png')}}" alt="Preview" id="preview" width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <label>Nuestro equipo</label> <br>
                            <button type="button" class="button btn btn-primary" onclick="addCollaborator()">
                                <i class="fa fa-plus"></i> Registrar colaborador
                            </button>
                            <?php $idx = 0;?>
                            @foreach ($data->ourTeam as $person)
                                <div class="row mt-2">
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" class="form-control" name="ourTeam[{{$idx}}][name]" id="name_{{$idx}}" value="{{$person->name}}">
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" class="form-control" name="ourTeam[{{$idx}}][job]" id="job_{{$idx}}" value="{{$person->job}}">
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <input type="file" class="form-control" name="ourTeam[{{$idx}}][img]" id="img_{{$idx}}" accept="image/png, image/gif, image/jpeg, image/jpg">
                                    </div>
                                    <div class="col-xs-12 col-md-1">
                                        <button type="button" class="btn btn-danger" title="Eliminar" onclick="deleteCollaborator({{$idx}},'{{$person->name}}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php $idx++;?>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 alerta">
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-block" onclick="updateAboutUsData()">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
		document.getElementById('image').onchange = function (e) {
			// Creamos el objeto de la clase FileReader
			let reader = new FileReader();
			let type = e.target.files[0].type;
			if (type == "image/png" ||
				type == "image/jpg" ||
				type == "image/jpeg") {
				// Leemos el archivo subido y se lo pasamos a nuestro fileReader
				reader.readAsDataURL(e.target.files[0]);
				// Le decimos que cuando este listo ejecute el código interno
				reader.onload = function(){
					document.getElementById('preview').src = reader.result;
				};
			} else {
				alert('Archivo con formato invalido');
			}
		}
	</script>
@endsection