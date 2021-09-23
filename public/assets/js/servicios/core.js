function saveService() {
    let name        = jQuery('#name');
    let description = jQuery('#description');
    let img         = jQuery('#img');
    let type        = jQuery('#type');

    let fields = (type.val() == "registrar") ? [name, description, img] : [name, description];
    let errors = [];

    for (let i = 0; i < fields.length; i++) {
        let value = fields[i].val();
        if(value == '' ||value == ' '){
            errors.push(`El campo <b>${fields[i].attr('lbl')}</b> es obligatorio.`);
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

        const form = document.getElementById('serviceForm');
        const formData = new FormData(form);

        let service = (type.val() == "registrar") ? '/api/service-insert' : '/api/service-update';

        jQuery.ajax({
            type: "POST",
            url: `${HOST}${service}`,
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

function serviceStatus(productLineId, status) {
    jQuery.ajax({
        type: "POST",
        url: `${HOST}/api/service-status`,
        data: {
            productLineId,
            status
        },
        success: function(response){
            console.log(response);
            let res = JSON.parse(response);
            if(res.status == 200) {
                window.open('/app/servicios', '_self');
            }
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}