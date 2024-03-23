function uploadImage(){
    const name_f = jQuery("#name");
    const desc_f = jQuery("#description");
    const file_f = jQuery("#file");

    let fields = [name_f, desc_f];
    let errors = [];

    for (let i = 0; i < fields.length; i++) {
        let value = fields[i].val();
        if(value == '' ||value == ' '){
            errors.push(`El campo <b>${fields[i].attr('lbl')}</b> es obligatorio.`);
        }
    }

    if (!validateImgField(file_f)) {
        errors.push(`Debe seleccionar un <b>Archivo</b> de imagen para cargar`);
    }

    if(errors.length > 0){
        let alert = '<div class="alert alert-danger"><ul>';
        jQuery.each(errors, function(index, item){
            alert += '<li>'+item+'</li>';
        });
        alert += '</ul></div>';
        jQuery('#add-image-alert').html(alert);
    }else{
        const body = new FormData();
        body.append("name", name_f.val());
        body.append("description", desc_f.val());
        body.append("img", file_f[0].files[0]);
        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/upload-image-to-gallery`,
            data: body,
            contentType: false,
            processData: false,
            success: function(response){
                window.open("/app/galeria", "_self");
            },
            error: function(err){
                console.log('[ERROR] ', err);
            }
        })
    }
}

function validateImgField(file_f) {
    console.log('validateImgField.file_f: ', file_f[0].files);
    return file_f[0].files.length > 0;
}

function removeGalleryImage(galeryImageId, url) {
    jQuery('.modal').modal({backdrop: 'static', keyboard: false});
    jQuery('.modal-title').html('Eliminar imagen')
    jQuery('.modal-body').html(`<p>Confirme si desea eliminar la imágen de la galería</p>`);
    jQuery('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-danger btn-accept"><i class="fa fa-trash"></i> Si, eliminar</button>');

    jQuery('.btn-accept').click(function(){
        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/delete-image`,
            data: {
                galeryImageId,
                url
            },
            success: function(res){
                console.log('Response: ', res.response);
                if (res.response === 1) {
                    window.open("/app/galeria", "_self");
                }
            },
            error: function(err){
                console.log('[ERROR]', err);
            }
        })
    });
}
