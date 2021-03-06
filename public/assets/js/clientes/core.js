function getAllCustomers(){
    jQuery.ajax({
        url: `${HOST}/api/clients/`,
        success: function(response){
            let res = JSON.parse(response);
            
            if(res.length > 0){
                sessionStorage.setItem('listado-clientes', response);
                renderCustomersList(res);
            } else {
                jQuery('#lista-clientes').html('<tr>'+
                    '<td>--</td>'+
                    '<td>--</td>'+
                    '<td>--</td>'+
                    '<td>--</td>'+
                '</tr>');
            }
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}

function renderCustomersList(list) {
    jQuery('#lista-clientes').html('');
    jQuery.each(list, function(index, value){
        let identificacion = value['docType'] + " - " + value['docNum'];
        jQuery('#lista-clientes').append('<tr>'+
            '<td>'+identificacion+'</td>'+
            '<td>'+value['fullname']+'</td>'+
            '<td>'+value['email']+'</td>'+
            '<td>'+
                '<button class="btn btn-primary m-1" title="Ver información" onclick=showCustomerData('+value['docNum']+')><i class="fa fa-eye"></i></button>'+
                '<button class="btn btn-primary m-1" title="Crear factura"><i class="fas fa-file-invoice"></i></button>'+
                '<button class="btn btn-primary m-1" title="Crear cotización"><i class="fas fa-list"></i></button>'+
            '</td>'+
        '</tr>');
    });
}

function filterCustomersByDocument(document){
    const customersList = JSON.parse(sessionStorage.getItem('listado-clientes'));
    const filerList = customersList.filter((item)=>{
        return item.docNum == document
    });
    if(filerList.length > 0){
        renderCustomersList(filerList);
    }else{
        renderCustomersList(customersList);
    }
}

function showCustomerData(document){
    const customersList = JSON.parse(sessionStorage.getItem('listado-clientes'));
    const customer = customersList.filter((item)=>item.docNum == document);

    let identificacion = customer[0].docType+" - "+customer[0].docNum;

    jQuery('.modal').modal({backdrop: 'static', keyboard: false});
    jQuery('.modal-title').html('Información del cliente')
    jQuery('.modal-body').html('<div class="row">'+
            '<div class="col-12">'+
                '<label>Identificación</label>'+
                '<input type="text" class="form-control" value="'+identificacion+'" disabled="true"/>'+
            '</div>'+
            '<div class="col-xs-12 col-md-6">'+
                '<label>Nombre</label>'+
                '<input type="text" class="form-control" value="'+customer[0].name+'" lbl="Primer nombre" id="name"/>'+
            '</div>'+
            '<div class="col-xs-12 col-md-6">'+
                '<label>Apellido</label>'+
                '<input type="text" class="form-control" value="'+customer[0].surname+'" lbl="Segundo nombre" id="surname"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<label>Correo electrónico</label>'+
                '<input type="text" class="form-control" value="'+customer[0].email+'" lbl="Correo electrónico" id="email"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<label>Dirección</label>'+
                '<input type="text" class="form-control" value="'+customer[0].address+'" lbl="Dirección" id="address"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<label>Teléfono</label>'+
                '<input type="text" class="form-control" value="'+customer[0].phone+'" lbl="Teléfono" id="phone"/>'+
            '</div>'+
            '<div class="col-12">'+
                '<hr>'+
            '</div>'+
            '<div class="col-12 alerta">'+
            '</div>'+
        '</div>');
    jQuery('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-success btn-accept"><i class="fa fa-save"></i> Actualizar información</button>');

    jQuery('.btn-accept').click(function(){
        let name    = jQuery('#name');
        let surname = jQuery('#surname');
        let email   = jQuery('#email');
        let address = jQuery('#address');
        let phone   = jQuery('#phone');

        let fields = [name, surname, email, address, phone];
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

            jQuery.ajax({
                type: "POST",
                url: `${HOST}/api/client-update`,
                data:{
                    userId:     customer[0].userId,
                    name:       name.val(),
                    surname:    surname.val(),
                    email:      email.val(),
                    phone:      phone.val(),
                    address:    address.val()
                },
                success: function(response){
                    console.log('[SUCCESS]', response);
                    let res = JSON.parse(response);
                    let alertType = (res.status == 200) ? 'alert-success' : 'alert-warning';
                    let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

                    jQuery('.alerta').html(html);
                    getAllCustomers();
                },
                error: function(err){
                    console.log('[ERROR]', err);
                }
            })
        }
    })
}

function searchCity(dpmntId) {
    if (dpmntId) {
        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/get-cities-by-deparment-id`,
            data: {
                dpmntId
            },
            success: function(response) {
                let res = JSON.parse(response);
                jQuery('#cityId').attr('disabled', false);
                jQuery('#cityId').html('<option value="">-Seleccione</option>');
                jQuery.each(res, function(index, value) {
                    jQuery('#cityId').append('<option value="'+value.cityId+'">'+value.name+'</option>');
                });
            }
        })
    } else {
        console.log('No ha seleccionado ningún departamento!');
        jQuery('#cityId').attr('disabled', true);
        jQuery('#cityId').html('<option value="">-Seleccione</option>');
    }
}

function saveCustomer(){
    let documentTypeId  = jQuery('#documentTypeId');
    let docNum          = jQuery('#docNum');
    let name            = jQuery('#name');
    let surname         = jQuery('#surname');
    let email           = jQuery('#email');
    let dpmntId         = jQuery('#dpmntId');
    let cityId          = jQuery('#cityId');
    let address         = jQuery('#address');
    let phone           = jQuery('#phone');

    let fields = [documentTypeId, docNum, name, surname, email, dpmntId, cityId, address, phone];
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

        jQuery.ajax({
            type: "POST",
            url: `${HOST}/api/client-insert`,
            data:{
                documentTypeId: documentTypeId.val(),
                docNum:  docNum.val(),
                name:    name.val(),
                surname: surname.val(),
                email:   email.val(),
                address: address.val(),
                phone:   phone.val(),
                cityId:  cityId.val(),
            },
            success: function(response){
                let res = JSON.parse(response);
                let alertType = (res.status == 201) ? 'alert-success' : 'alert-warning';
                let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

                jQuery('.alerta').html(html);
                getAllCustomers();
            },
            error: function(err){
                console.log('[ERROR]', err);
            }
        })
    }

}