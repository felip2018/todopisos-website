function productRegister(productLineId) {
    console.log(`ProductLineId::${productLineId}`);
    jQuery('.modal').modal({backdrop: 'static', keyboard: false});
    jQuery('.modal-title').html('Registrar nuevo producto')
    jQuery('.modal-body').html('<form id="productForm" class="row">'+
            '<input type="hidden" class="form-control" id="productLineId" name="productLineId" value="'+productLineId+'"/>'+
            '<div class="col-12">'+
                '<label>Nombre</label>'+
                '<input type="text" class="form-control" lbl="Nombre" id="name" name="name"/>'+
            '</div>'+
            '<div class="col-xs-12 col-md-12">'+
                '<label>Descripción</label>'+
                '<textarea class="form-control" lbl="Descripción" id="description" name="description" rows="4"></textarea>'+
            '</div>'+
            '<div class="col-12">'+
                '<label>Foto</label>'+
                '<input type="file" class="form-control" lbl="Foto" id="img" name="img" accept="image/png, image/gif, image/jpeg, image/jpg"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<label>¿Es un producto destacado?</label>'+
                '<select type="text" class="form-control" lbl="¿Es un producto destacado?" id="outstanding" name="outstanding">'+
                    '<option value="">-Seleecione</option>'+
                    '<option value="SI">SI</option>'+
                    '<option value="NO">NO</option>'+
                '</select>'+
            '</div>'+
            '<div class="col-12">'+
                '<hr>'+
            '</div>'+
            '<div class="col-12 alerta-modal">'+
            '</div>'+
        '</form>');
    jQuery('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-success btn-accept"><i class="fa fa-save"></i> Guardar</button>');

    jQuery('.btn-accept').click(function(){
        let name            = jQuery('#name');
        let description     = jQuery('#description');
        let img             = jQuery('#img');
        let outstanding     = jQuery('#outstanding');

        let fields = [name, description, img, outstanding];
        let errors = [];

        for(i=0; i < fields.length; i++){
            let valor = fields[i].val();

            if(valor == '' || valor == ' '){
                errors.push(`El campo <b>${fields[i].attr('lbl')}</b> es obligatorio.`)
            }
        }

        if(errors.length > 0){
            let alert = '<div class="alert alert-danger"><ul>';
            jQuery.each(errors, function(index, item){
                alert += '<li>'+item+'</li>';
            });
            alert += '</ul></div>';

            jQuery('.alerta-modal').html(alert);
        }else{
            jQuery('.alerta-modal').html('<div class="justify-content-center">'+
                '<img src="/assets/img/loader.gif" />'+
            '</div>');

            const form = document.getElementById('productForm');
            const formData = new FormData(form);

            jQuery.ajax({
                type: "POST",
                url: `${HOST}/api/product-insert`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response);
                    let res = JSON.parse(response);
                    let alertType = (res.status == 201) ? 'alert-success' : 'alert-warning';
                    let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

                    jQuery('.alerta-modal').html(html);
                    jQuery('.modal-footer').html('<button type="button" class="btn btn-success btn-accept"><i class="fa fa-check"></i> Aceptar</button>');

                    jQuery('.btn-accept').click(function(){
                        window.open('/app/servicios/productos/'+productLineId, '_self');
                    });
                },
                error: function(err){
                    console.log('[ERROR]', err);
                }
            })
        }
    });
}

function productStatus(productLineId, productId, status) {
    jQuery.ajax({
        type: "POST",
        url: `${HOST}/api/product-status`,
        data: {
            productId,
            status
        },
        success: function(response){
            console.log(response);
            let res = JSON.parse(response);
            if(res.status == 200) {
                window.open('/app/servicios/productos/'+productLineId, '_self');
            }
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}

function updateProduct(productId) {
    let name            = jQuery('#name');
    let description     = jQuery('#description');
    let img             = jQuery('#img');
    let outstanding     = jQuery('#outstanding');

    let fields = [name, description, outstanding];
    let errors = [];

    for(i=0; i < fields.length; i++){
        let valor = fields[i].val();

        if(valor == '' || valor == ' '){
            errors.push(`El campo <b>${fields[i].attr('lbl')}</b> es obligatorio.`)
        }
    }

    if(errors.length > 0){
        let alert = '<div class="alert alert-danger"><ul>';
        jQuery.each(errors, function(index, item){
            alert += '<li>'+item+'</li>';
        });
        alert += '</ul></div>';

        jQuery('.alerta').html(alert);
    }else{
        jQuery('.alerta').html('<div class="justify-content-center">'+
            '<img src="/assets/img/loader.gif" />'+
        '</div>');

        const form = document.getElementById('productForm');
        const formData = new FormData(form);

        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/product-update`,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
                let res = JSON.parse(response);
                let alertType = (res.status == 201) ? 'alert-success' : 'alert-warning';
                let html = '<div class="alert '+alertType+'">'+res.message+'</div>';
                jQuery('.alerta').html(html);
            },
            error: function(err){
                console.log('[ERROR]', err);
            }
        })
    }
}