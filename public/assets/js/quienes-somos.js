function updateAboutUsData() {
    const form = document.getElementById('aboutUsForm');
    const formData = new FormData(form);

    jQuery.ajax({
        type: "POST",
        url: `${HOST}/api/update-about-data`,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response);
            let res = JSON.parse(response);
            let alertType = (res.status == 200) ? 'alert-success' : 'alert-warning';
            let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

            jQuery('.alerta').html(html);
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}

function addCollaborator() {
    jQuery('.modal').modal({backdrop: 'static', keyboard: false});
    jQuery('.modal-title').html('Registrar nuevo colaborador')
    jQuery('.modal-body').html('<form id="collaboratorForm" class="row">'+
            '<div class="col-12">'+
                '<label>Nombre</label>'+
                '<input type="text" class="form-control" lbl="Nombre" id="name" name="name"/>'+
            '</div>'+
            '<div class="col-xs-12 col-md-12">'+
                '<label>Cargo</label>'+
                '<input type="text" class="form-control" lbl="Cargo" id="job" name="job"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<label>Foto</label>'+
                '<input type="file" class="form-control" lbl="Foto" id="img" name="img"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<hr>'+
            '</div>'+
            '<div class="col-12 alerta-modal">'+
            '</div>'+
        '</form>');
    jQuery('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-success btn-accept"><i class="fa fa-save"></i> Guardar</button>');

    jQuery('.btn-accept').click(function(){
        let name = jQuery('#name');
        let job  = jQuery('#job');

        let fields = [name, job];
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

            const form = document.getElementById('collaboratorForm');
            const formData = new FormData(form);

            jQuery.ajax({
                type: "POST",
                url: `${HOST}/api/collaborator-insert`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response);
                    let res = JSON.parse(response);
                    let alertType = (res.status == 200) ? 'alert-success' : 'alert-warning';
                    let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

                    jQuery('.alerta-modal').html(html);
                    jQuery('.modal-footer').html('<button type="button" class="btn btn-success btn-accept"><i class="fa fa-check"></i> Aceptar</button>');

                    jQuery('.btn-accept').click(function(){
                        window.open('/app/quienes-somos', '_self');
                    });
                },
                error: function(err){
                    console.log('[ERROR]', err);
                }
            })
        }
    });
}

function deleteCollaborator(idx, name) {
    jQuery('.modal').modal({backdrop: 'static', keyboard: false});
    jQuery('.modal-title').html('Eliminar colaborador')
    jQuery('.modal-body').html('<div id="collaboratorForm" class="row">'+
            '<div class="col-12">'+
                '<label>Nombre</label>'+
                '<p>Esta seguro de eliminar a <b>'+name+'</b> de la lista de colaboradores?</p>'+
            '</div>'+
            '<div class="col-12">'+
                '<hr>'+
            '</div>'+
            '<div class="col-12 alerta-modal">'+
            '</div>'+
        '</div>');
    jQuery('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-danger btn-accept"><i class="fa fa-trash"></i> Si, eliminar</button>');

    jQuery('.btn-accept').click(function(){

        jQuery('.alerta-modal').html('<div class="justify-content-center">'+
            '<img src="/assets/img/loader.gif" />'+
        '</div>');

        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/collaborator-delete`,
            data: {
                idx
            },
            success: function(response){
                console.log(response);
                let res = JSON.parse(response);
                let alertType = (res.status == 200) ? 'alert-success' : 'alert-warning';
                let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

                jQuery('.alerta-modal').html(html);
                jQuery('.modal-footer').html('<button type="button" class="btn btn-success btn-accept"><i class="fa fa-check"></i> Aceptar</button>');

                jQuery('.btn-accept').click(function(){
                    window.open('/app/quienes-somos', '_self');
                });
            },
            error: function(err){
                console.log('[ERROR]', err);
            }
        })
        
    });
}