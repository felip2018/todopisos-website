function addProductToQuotation(productId, name, img) {
    const obj = {
        productId,
        name,
        img
    };

    if (localStorage.getItem('carrito')) {
        const carrito = JSON.parse(localStorage.getItem('carrito'));
        const filter = carrito.filter(item=>item.productId === obj.productId);

        if(filter.length === 0) {
            // Agregar producto al carrito
            carrito.push(obj);
            localStorage.setItem('carrito', JSON.stringify(carrito));
        }
        jQuery('#numberItems').html(carrito.length);

    } else {
        let carrito = [obj];
        localStorage.setItem('carrito', JSON.stringify(carrito));
        jQuery('#numberItems').html('1');
    }
}

function renderQuotationListWeb() {
    if (localStorage.getItem('carrito')) {
        const carrito = JSON.parse(localStorage.getItem('carrito'));
        jQuery('#itemsList').html('');
        jQuery.each(carrito, function(key, value){
            //console.log(value['img']);
            jQuery('#itemsList').append('<div class="row" style="padding:10px;border:1px solid #CCCCCC; border-radius:5px;">'+
                '<div class="col-xs-12 col-md-2">'+
                    '<img src="../'+value['img']+'" width="100%"/>'+
                '</div>'+
                '<div class="col-xs-12 col-md-10">'+
                    '<b>'+value['name']+'</b>'+
                    '<hr>'+
                    '<button class="btn btn-danger" title="Eliminar" style="float:right" onclick=deleteItem('+key+',"WEB")>'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</div>'+
            '</div>');
        });

    } else {
        jQuery('#itemsList').html('<p>No se han agregado elementos a la lista de cotización.</p>');
    }
}

function renderQuotationListApp() {
    if (localStorage.getItem('carrito')) {
        const carrito = JSON.parse(localStorage.getItem('carrito'));
        jQuery('#itemsList').html('');
        if (carrito.length > 0){
            jQuery.each(carrito, function(key, value){
                
                jQuery('#itemsList').append('<div class="row" style="padding:10px;border:1px solid #CCCCCC; border-radius:5px;">'+
                    '<div class="col-xs-12 col-md-2">'+
                        '<img src="../'+value['img']+'" width="100%"/>'+
                    '</div>'+
                    '<div class="col-xs-12 col-md-10">'+
                        '<b>'+value['name']+'</b>'+
                        '<input type="hidden" name="product['+key+'][productId]" value="'+value['productId']+'"/>'+
                        '<input type="hidden" name="product['+key+'][name]" value="'+value['name']+'"/>'+
                        '<textarea class="form-control" name="product['+key+'][comment]" rows="2" placeholder="Agregar comentarios a la cotización de este producto (opcional)"></textarea>'+
                        '<label>Unidades a cotizar</label>'+
                        '<input type="number" class="form-control col-xs-12 col-md-2" min="1" name="product['+key+'][quantity]" value="1"/>'+
                        '<hr>'+
                        '<button class="btn btn-danger" title="Eliminar" style="float:right" onclick=deleteItem('+key+',"APP")>'+
                            '<i class="fa fa-trash"></i>'+
                        '</button>'+
                    '</div>'+
                '</div>');
            });
        } else {
            jQuery('#itemsList').html('<p>No se han agregado elementos a la lista de cotización.</p>');
        }

    } else {
        jQuery('#itemsList').html('<p>No se han agregado elementos a la lista de cotización.</p>');
    }
}

function deleteItem(key, mode) {
    const carrito = JSON.parse(localStorage.getItem('carrito'));
    carrito.splice(key,1);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    (mode === 'APP') ? renderQuotationListApp() : renderQuotationListWeb();
}

function clearQuotationCar() {
    localStorage.removeItem('carrito');
    renderQuotationListApp();
}

function quotationRequest() {
    if (localStorage.getItem('carrito')) {
        const carrito = JSON.parse(localStorage.getItem('carrito'));
        const userData = JSON.parse(sessionStorage.getItem('user-data'));
        if (carrito.length > 0) {
            const customerObservations = jQuery('#customerObservations').val();
            let form = document.getElementById('quotationForm');
            let formData = new FormData(form);
            formData.append('userId', userData.userId);
            formData.append('userData', JSON.stringify(userData));
            formData.append('customerObservations', customerObservations);
            formData.append('quotationStatus', 'PENDIENTE');
            jQuery.ajax({
                type:"POST",
                url: `${HOST}/api/quotation-insert`,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('Response', response);
                    let res = JSON.parse(response);
                    let alertType = (res.status == 201) ? 'alert-success' : 'alert-warning';
                    let html = '<div class="alert '+alertType+'">'+res.message+'</div>';

                    jQuery('.alerta').html(html);

                    (res.status == 201) ? clearQuotationCar() : '';
                }
            })

        } else {
            jQuery('#alerta').html('<div class="alert alert-warning">'+
                '<p>No hay elementos en la lista de cotización.</p>'+
            '</div>');
        }

    } else {
        jQuery('#alerta').html('<div class="alert alert-warning">'+
            '<p>No hay elementos en la lista de cotización.</p>'+
        '</div>');
    }
}

function setTotalPrice(idx) {
    let quantity = jQuery('#quantity_'+idx);
    let unitPrice = jQuery('#unitPrice_'+idx);
    let totalPrice = jQuery('#totalPrice_'+idx);

    let price = parseInt(quantity.val()) * parseInt(unitPrice.val());

    totalPrice.val(price);
}

function showQuotation(quotationId) {
    console.log(`[SHOW] QuotationId: ${quotationId}`);
    jQuery.ajax({
        type:"POST",
        url:`${HOST}/api/get-quotation-by-id`,
        data: {
            quotationId
        },
        success: function(response) {
            console.log(response);
            let res = JSON.parse(response);
            if (res.status == 200) {

                let detail = '';
                let idx = 0;
                jQuery.each(res.detail, function(key, value) {
                    
                    let comment = (value['productComment']) ? value['productComment'] : 'Sin descripción adicional'

                    detail +=   '<div style="background-color:#DDDDDD;padding:5px;border-radius:5px;margin-top:10px;">';
                    detail +=      '<b>'+value['productName']+'</b>';
                    detail +=      '<p>'+comment+'</p>';
                    detail +=      '<textarea class="form-control" name="product['+idx+'][description]" rows="3"></textarea>';
                    detail +=      '<table>';
                    detail +=           '<tr>';
                    detail +=               '<td>';
                    detail +=                   '<label>Cantidad</label>';
                    detail +=                   '<input type="number" class="form-control" min="1" name="product['+idx+'][quantity]" value="'+value['quantity']+'" id="quantity_'+idx+'"/>';
                    detail +=               '</td>';
                    detail +=               '<td>';
                    detail +=                   '<label>Valor unitario</label>';
                    detail +=                   '<input type="number" class="form-control" min="1" name="product['+idx+'][unitPrice]" onblur="setTotalPrice('+idx+')" id="unitPrice_'+idx+'"/>';
                    detail +=               '</td>';
                    detail +=               '<td>';
                    detail +=                   '<label>Valor total</label>';
                    detail +=                   '<input type="number" class="form-control" min="1" name="product['+idx+'][totalPrice]" disabled id="totalPrice_'+idx+'"/>';
                    detail +=               '</td>';
                    detail +=           '</tr>';
                    detail +=      '</table>';
                    detail +=   '</div>';

                    idx++;
                });
                detail += '</table>';

                jQuery('.modal').modal({backdrop: 'static', keyboard: false});
                jQuery('.modal-title').html('Detalle solicitud de cotización');
                jQuery('.modal-body').html('<div class="row">'+
                    '<div class="col-12">'+
                        '<b>Información del cliente</b>'+
                        '<table class="table">'+
                            '<tr>'+
                                '<td>Nombre </td>'+
                                '<td>'+res.quotation.fullname+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Documento </td>'+
                                '<td>'+res.quotation.document+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Teléfono</td>'+
                                '<td>'+res.quotation.phone+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Dirección</td>'+
                                '<td>'+res.quotation.address+'</td>'+
                            '</tr>'+
                        '</table>'+
                    '</div>'+
                    '<hr>'+
                    '<div class="col-12">'+
                        '<b>Detalle de la solicitud</b>'+
                        '<form id="quotationResponseForm">'+
                            detail +
                        '</form>'+
                    '</div>'+
                '</div>')
            } else {
                console.error(response);
            }
        }
    })
}