function saveContactForm() {

    const name_f    = jQuery("#name");
    const email_f   = jQuery("#email");
    const phone_f   = jQuery("#phone");
    const message_f = jQuery("#message");

    let fields = [name_f, email_f, phone_f, message_f];
    let errors = [];

    for (let i = 0; i < fields.length; i++) {
        let value = fields[i].val();
        if(value == '' || value == ' '){
            errors.push(`El campo <b>${fields[i].attr('lbl')}</b> es obligatorio.`);
        }
    }

    if(errors.length > 0){
        let alert = '<div class="alert alert-danger"><ul>';
        jQuery.each(errors, function(index, item){
            alert += '<li>'+item+'</li>';
        });
        alert += '</ul></div>';

        jQuery('.alert').html(alert);
    }else {
        jQuery('.alert').html(`<div class="justify-content-center">
            <img src="/assets/img/loader.gif" />
        </div>`);
        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/save-contact-form`,
            data: {
                name: name_f.val(),
                email: email_f.val(),
                phone: phone_f.val(),
                message: message_f.val()
            },
            success: function(res){
                let alertType = (res.status == 201) ? 'alert-success' : 'alert-warning';
                let html = `<div class="alert ${alertType}">${res.response}</div>`;

                name_f.val("");
                email_f.val("");
                phone_f.val("");
                message_f.val("");

                jQuery('.alert').html(html);
            },
            error: function(err){
                console.log('[ERROR]', err);
            }
        })
    }
}

function updateContactFormStatus(id, status) {
    jQuery.ajax({
        type: "POST",
        url: `${HOST}/api/update-form-status`,
        data: {
            id,
            status
        },
        success: function(res){
            //window.open("/app/contact-form", "_self");
            window.location.reload();
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}
