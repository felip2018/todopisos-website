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
        jQuery.each(carrito, function(key, value){
            
            jQuery('#itemsList').append('<div class="row" style="padding:10px;border:1px solid #CCCCCC; border-radius:5px;">'+
                '<div class="col-xs-12 col-md-2">'+
                    '<img src="../'+value['img']+'" width="100%"/>'+
                '</div>'+
                '<div class="col-xs-12 col-md-10">'+
                    '<b>'+value['name']+'</b>'+
                    '<input type="hidden" name="product['+key+'][productId]" value="'+value['productId']+'"/>'+
                    '<textarea class="form-control" name="product['+key+'][comment]" rows="2" placeholder="Agregar comentarios"></textarea>'+
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
}

function deleteItem(key, mode) {
    const carrito = JSON.parse(localStorage.getItem('carrito'));
    carrito.splice(key,1);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    (mode === 'APP') ? renderQuotationListApp() : renderQuotationListWeb();
}