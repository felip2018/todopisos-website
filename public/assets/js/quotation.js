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