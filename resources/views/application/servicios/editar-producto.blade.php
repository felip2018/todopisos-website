@extends('templates.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                Editar producto
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-12">
			<div class="row justify-content-center">
				<div class="col-xs-12 col-md-8" >
					<div class="row">
						<div class="col-xs-12">
							<div class="col-12 form-container">
								<form class="row" method="POST" enctype="multipart/form-data" id="productForm">
									<input type="hidden" name="type" id="type" value="editar">
									<input type="hidden" name="productId" id="type" value="{{$producto->productId}}">
									<div class="col-12">
										<label>Nombre</label>
										<input type="text" class="form-control" lbl="Nombre" id="name" name="name" value="{{$producto->name}}"/>
									</div>
									<div class="col-12">
										<label>Descripción del producto</label>
										<textarea class="form-control" lbl="Descripción del servicio" id="description" rows="5" name="description">{{$producto->description}}</textarea>
									</div>
									<div class="col-12">
										<label>Imagen</label>
										<input type="file" class="form-control" lbl="Imagen" id="img" name="img" accept="image/png, image/gif, image/jpeg, image/jpg"/>
									</div>
									<div class="col-12">
										<div class="row">
											<div class="col-xs-12 col-md-6">
												<label>Actual</label>
												<img src="{{asset($producto->img)}}" alt="Preview" width="100%">
											</div>
											<div class="col-xs-12 col-md-6">    
												<label>Nueva</label>
												<img src="{{asset('assets/img/no-image.png')}}" alt="Preview" id="preview" width="100%">
											</div>
										</div>
									</div>
                                    <div class="col-12">
                                        <label>¿Es un producto destacado?</label>
                                        <select type="text" class="form-control" lbl="¿Es un producto destacado?" id="outstanding" name="outstanding">
                                            <option value="">-Seleecione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
									<div class="col-12">
										<hr>
									</div>
									<div class="col-12 alerta">
									</div>
									<div class="col-12">
										<button type="button" class="btn btn-primary btn-block" onclick="updateProduct({{$producto->productId}})">
											<i class="fa fa-save"></i> Guardar
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<script>
        jQuery('#outstanding').val(<?php echo '"'.$producto->outstanding.'"';?>);

		document.getElementById('img').onchange = function (e) {
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