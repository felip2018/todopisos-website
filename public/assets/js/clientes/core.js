function getAllCustomers(){
    jQuery.ajax({
        url: "http://localhost:8000/api/clients/",
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
        let identificacion = value['tipo_identi'] + " - " + value['num_identi'];
        jQuery('#lista-clientes').append('<tr>'+
            '<td>'+identificacion+'</td>'+
            '<td>'+value['nombre']+'</td>'+
            '<td>'+value['email']+'</td>'+
            '<td>'+
                '<button class="btn btn-primary"><i class="fa fa-eye"></i></button>'+
            '</td>'+
        '</tr>');
    });
}

function filterCustomersByDocument(document){
    const customersList = JSON.parse(sessionStorage.getItem('listado-clientes'));
   
    const filerList = customersList.filter((item)=>{
        return item.num_identi == document
    });
    if(filerList.length > 0){
        renderCustomersList(filerList);
    }else{
        renderCustomersList(customersList);
    }
}