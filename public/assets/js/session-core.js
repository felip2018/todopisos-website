function login(){
    let user = jQuery('#user');
    let pass  = jQuery('#pass');

    let fields = [user, pass];
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
        jQuery('.alerta').html(`<div class="justify-content-center">
            <img src="/assets/img/loader.gif" />
        </div>`);

        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/login`,
            data:{
                user: 	user.val(),
                pass:   pass.val()
            },
            success: function(response){
                let res = JSON.parse(response);
                if(res.status == 200){
                    const userData = res.data[0];
                	// guardar session storage y redireccionar a la aplicacion
                	sessionStorage.setItem('is-loggin', 'true');
                	sessionStorage.setItem('user-data', JSON.stringify(userData))

                    jQuery.ajax({
                        type: "POST",
                        url: `${HOST}/api/initial-route`,
                        data: {
                            profileId: userData.profileId
                        },
                        success: function(response) {
                            console.log('res', response)
                            let res = JSON.parse(response);
                            window.open(res.route,'_self');
                        }
                    });
                }else{
                	let alertType = (res.status == 200) ? 'alert-success' : 'alert-warning';
                	let html = '<div class="alert '+alertType+'">'+res.message+'</div>';
                	jQuery('.alerta').html(html);
            	}
            },
            error: function(err){
                console.log('[ERROR]', err);
            }
        })
    }

}

function validateSession(){
	const isLogin = sessionStorage.getItem('is-loggin');
	return isLogin;
}

function closeSession(){
	sessionStorage.clear();
	window.open('/iniciar-sesion', '_self');
}

function getCustomerData() {
    if (sessionStorage.getItem('user-data')) {
        customerData = JSON.parse(sessionStorage.getItem('user-data'));
        return customerData;
    }
    return;
}
