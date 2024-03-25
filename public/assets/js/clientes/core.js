function getAllCustomers(){
    jQuery.ajax({
        url: `${HOST}/api/clients/`,
        success: function(response){
            let res = JSON.parse(response);

            if(res.length > 0){
                sessionStorage.setItem('listado-clientes', response);
                renderCustomersList(res);
            } else {
                jQuery('#lista-clientes').html(`<tr>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                </tr>`);
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
        jQuery('#lista-clientes').append(`
            <tr>
                <td>${identificacion}</td>
                <td>${value['fullname']}</td>
                <td>${value['email']}</td>
                <td>
                    <button class="btn btn-primary m-1" title="Ver información" onclick=showCustomerData(${value['docNum']})>
                        <i class="fa fa-eye"></i>
                    </button>
                    <a href="/app/clientes/registrar-documento/1/${value['userId']}" class="btn btn-info m-1" title="Crear remisión">
                        <i class="fas fa-file-invoice"></i>
                    </a>
                    <a href="/app/clientes/registrar-documento/2/${value['userId']}" class="btn btn-warning m-1" title="Crear cotización">
                        <i class="fas fa-list"></i>
                    </a>
                    <a href="/app/clientes/ver-documentos/${value['userId']}" class="btn btn-secondary m-1" title="Ver historial">
                        <i class="fas fa-history"></i>
                    </a>
                </td>
            </tr>
        `);
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

function searchProductLines() {
    const productLinesField = jQuery("#productLineId");
    jQuery.ajax({
        type: "GET",
        url: `${HOST}/api/get-product-lines`,
        success: function(res) {
            const productLines = res.response;
            sessionStorage.setItem("product-lines", JSON.stringify(productLines));
            productLinesField.append(`<option value="">-Seleccione</option>`);
            jQuery.each(productLines, function(index, value) {
                productLinesField.append(`<option value="${value['productLineId']}">${value['name']}</option>`);
            });
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}

function searchProducts() {
    const productLineId = jQuery("#productLineId");
    const productsField = jQuery("#productId");
    productsField.html('');
    if (productLineId.val()) {
        const productLines = JSON.parse(sessionStorage.getItem("product-lines"));
        const line = productLines.find((pl) => pl.productLineId == productLineId.val());
        productsField.append(`<option value="">-Seleccione</option>`);
        jQuery.each(line.products, function(index, value) {
            productsField.append(`<option value="${value['productId']}">${value['name']}</option>`);
        });
    }
}

function addProduct() {
    const productLineId = jQuery("#productLineId");
    const productId = jQuery("#productId");
    const productDescription = jQuery("#productDescription");
    let quantity = jQuery("#quantity");
    let price = jQuery("#price");

    let fields = [productLineId, productId, quantity, price];
    let errors = [];

    for(i=0; i < fields.length; i++){
        let valor = fields[i].val();

        if(valor === ''){
            errors.push(`El campo <b>${fields[i].attr('lbl')}</b> es obligatorio.`)
        }
    }
    if(errors.length > 0){
        let alert = '<div class="alert alert-danger"><ul>';
        jQuery.each(errors, function(index, item){
            alert += '<li>'+item+'</li>';
        });
        alert += '</ul></div>';
        jQuery('#add-product-alert').html(alert);
    }else {
        const productLines = JSON.parse(sessionStorage.getItem("product-lines"));
        const line = productLines.find((pl) => pl.productLineId == productLineId.val());
        const product = line.products.find((p) => p.productId == productId.val());

        quantity = Number(quantity.val());
        price = Number(price.val());

        const productToAdd = {
            product,
            description: productDescription.val(),
            quantity,
            price,
            subtotal: (price * quantity)
        }

        if (!validateIfProductExists(productToAdd.product.productId)) {
            addProductToStorage(productToAdd);
            renderProductsFromStorage();
        }
    }
}

function validateIfProductExists(productId) {
    const storage = sessionStorage.getItem("elements");
    if (!storage) {
        return false;
    }
    const productsList = JSON.parse(storage);
    const exists = productsList.find((element) => element.product.productId == productId);
    return Boolean(exists);
}

function addProductToStorage(productToAdd) {
    const storage = sessionStorage.getItem("elements");
    if (!storage) {
        sessionStorage.setItem("elements", JSON.stringify([productToAdd]));
        return;
    }
    const productsList = JSON.parse(storage);
    productsList.push(productToAdd);
    sessionStorage.setItem("elements", JSON.stringify(productsList));
    return;
}

function removeProductFromStorage(index) {
    const productsList = JSON.parse(sessionStorage.getItem("elements"));
    productsList.splice(index, 1);
    sessionStorage.setItem("elements", JSON.stringify(productsList));
    renderProductsFromStorage();
    return;
}

let COP = new Intl.NumberFormat('es-ES', {
    style: 'currency',
    currency: 'COP',
});
function renderProductsFromStorage() {
    const storage = sessionStorage.getItem("elements");
    if (storage) {
        const productsList = JSON.parse(storage);
        const tbody = jQuery("#lista-productos");
        tbody.html("");
        let total = 0;
        jQuery.each(productsList, function (index, value) {
            tbody.append(`<tr>
                <td>
                    <button class="btn btn-danger" title="Eliminar producto de la lista" onclick="removeProductFromStorage(${index})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                <td>${index + 1}</td>
                <td>
                    ${value["product"]["name"]}<br>
                    [${value["description"]}]
                </td>
                <td>${COP.format(value["price"])}</td>
                <td>${value["quantity"]}</td>
                <td>${COP.format(value["subtotal"])}</td>
            </tr>`);
            total += value["subtotal"];
        });
        // jQuery("#total").html(`<span>${COP.format(total)}</span>`);
        jQuery("#total").val(total);
        jQuery("#total_f").html(`${COP.format(total)}`);
        calculateTotalPayment();
    }
}

function calculateTotalPayment() {
    const total_f =  jQuery("#total");
    const advancement_f = jQuery("#advancement");
    const total_pay_f = jQuery("#total_pay_f");
    total_pay_f.val("");
    if (total_f.val() !== "" && (advancement_f.val() !== "" || advancement_f.val() !== "0")) {
        const total = parseInt(total_f.val());
        const advc = parseInt(advancement_f.val());
        const totalPayment = total-advc;
        total_pay_f.html(`${COP.format(totalPayment)}`);
    }
}

function getProductsList() {
    const alert = jQuery("#form-alert");
    alert.html("");
    if (!sessionStorage.getItem("elements") ||
        JSON.parse(sessionStorage.getItem("elements").length === 0)) {
        alert.html(`<div class='alert alert-warning'>
            <p>Debe agregar elementos a la lista</p>
        </div>`);
        return;
    }
    const productsList = JSON.parse(sessionStorage.getItem("elements"));
    return productsList;
}

function saveDocument() {
    const userId_f  = jQuery("#userId");
    const type_f    = jQuery("#type");
    const total_f   = jQuery("#total");
    const obs_f     = jQuery("#observations");
    const adv_f     = jQuery("#advancement");

    const alert = jQuery("#form-alert");
    alert.html("");

    const products  = getProductsList();

    const formData = new FormData();
    formData.append("userId", userId_f.val());
    formData.append("type", type_f.val());
    formData.append("total", total_f.val());
    formData.append("observations", obs_f.val());
    formData.append("advancement", adv_f.val());
    formData.append("products", JSON.stringify(products));

    jQuery.ajax({
        type: "POST",
        url: `${HOST}/api/save-document`,
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            console.log('saveDocument.res: ', res);
            sessionStorage.removeItem("elements");
            window.open(`/app/clientes/ver-documentos/${userId_f.val()}`, "_self");
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })

}
