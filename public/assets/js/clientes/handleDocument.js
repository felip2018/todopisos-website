function getDocumentInfo(id) {
    const products_list_f = jQuery("#lista-productos");
    const doc_h_f = jQuery("#doc-header");
    const buttons_f = jQuery("#buttons-div");
    products_list_f.html("");
    doc_h_f.html("")
    buttons_f.html("");
    jQuery.ajax({
        type: "GET",
        url: `${HOST}/api/get-document-info/${id}`,
        contentType: false,
        processData: false,
        success: function(res) {
            // console.log('Response: ', res);

            const total_f = jQuery("#total");
            const advancement_f = jQuery("#advancement");
            const total_pay_f = jQuery("#total_pay");
            const obs_f = jQuery("#observations");

            if (res.response) {

                const {
                    idDocument,
                    type,
                    number,
                    total,
                    advancement,
                    balance,
                    products_list,
                    observations,
                    date
                } = res.response;

                const bg = type == "Remisión" ? "#48dbfb":"#feca57";

                buttons_f.html(`
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-info m-2" onclick="printDocument(${idDocument})">
                            <i class="fa fa-print"></i> Imprimir
                        </button>
                        <button class="btn btn-warning m-2">
                            <i class="fa fa-paper-plane"></i> Enviar
                        </button>
                    </div>
                </div>
                `);

                doc_h_f.html(`
                    <span class="status-span" style="background-color: ${bg}">${type} No. ${number}</span><br>
                    Fecha de creación: ${date}
                `);

                jQuery.each(products_list, function(key, p) {
                    const {
                        unitPrice,
                        quantity,
                        totalPrice,
                    } = p;
                    products_list_f.append(`<tr>
                        <td>${key+1}</td>
                        <td>
                            ${p["product"]["name"]}<br>
                            [${p["description"]}]
                        </td>
                        <td>${unitPrice}</td>
                        <td>${quantity}</td>
                        <td>${totalPrice}</td>
                    </tr>`);
                });

                total_f.html(`${COP.format(total)}`);
                advancement_f.html(`${COP.format(advancement)}`);
                total_pay_f.html(`${COP.format(balance)}`);

                obs_f.val(observations);
            }
        },
        error: function(err){
            console.log('[ERROR]', err);
        }
    })
}

function printDocument(id) {
    window.open(`/app/clientes/ver-detalle-documento-imprimir/${id}`, "_blank");
}

function sendDocument(id) {

}
