const URLS = window.origin;
const URL_HOME = URLS + "/gestock/";
const URL_AJAX = URL_HOME + "src/controllers/ajx.php";
// const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
let tables = {};

// Configuration globale pour inclure le token CSRF dans les en-têtes AJAX


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});




function btnReq(selector, message = 'Chargement...', icon = "fa-redo fa-spin") {
    $(selector).html(`
        <i class="fa ${icon}"></i> &nbsp; ${message}
        `);
    $(selector).attr("disabled", "disabled");
}


function btnRes(selector, message = 'Ajouter', icon = "fa-plus-circle") {
    $(selector).html(` <i class="fa ${icon}"></i> &nbsp; ${message}`);
    $(selector).attr("disabled", false);
}


function testDatable() {
    $.ajax({
        method: "POST",
        url: URL_AJAX,
        data: {
            action: 'bcharger_data_clients',
            length: 2,
            start: 2,
            search: $('#data-table-client').DataTable().search().value,
            draw: 1
        },
        // dataType: "JSON",
        beforeSend: function () {
            // $(".loader_backdrop2").css('display', "block");
            // btnReq("#" + id, "Traitement...");
        },
        success: function (data) {
            console.log(data);

        }
    });
}






function loadDataTable(tableId,selector,action) {
    if ($(selector + ':visible').length) {

        // testDatable();

        // return;
        
      tables[tableId] = $(selector).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": URL_AJAX,
            "type": "POST",
            "data": {
                action: action
            }
        }
    });
    }
}



/** DEBUT SECTION CLIENT */

loadDataTable('data-table-client', '#data-table-client', 'bcharger_data_clients');

bopenModalAddClient();
function bopenModalAddClient() {
    $('#ClientAddModal').click(function (e) {
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_client_add'
            },
            dataType: "JSON",
            beforeSend: function () {
                $(".loader_backdrop2").css('display', "block");
                // btnReq("#ClientAddModal", "Traitement...");

            },
            success: function (data) {
                // btnRes("#ClientAddModal", 'Ajouter un client', 'fa-plus');
                // ;
                console.log(data);
                

                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#client-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");


                }

            }
        })
    });
}

bAjouterClient();
function bAjouterClient() {
    $("body").delegate("#frmAddClientData", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $(".loader_backdrop2").css('display', "block");
                
                btnReq(".modal_footer", "Enregistrement...");
            },
            success: function(data) {
                console.log(data);
                    $(".loader_backdrop2").css('display', "none");

                btnRes(".modal_footer", "Ajouter le client", "fa-save");
                if (data.code == 200) {
                    tables['data-table-client'].ajax.reload(null, false);
                    $.notify(data.message, "success");
                    $("#client-modal").modal("hide");

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}

bOpenModalUpdateClient();
function bOpenModalUpdateClient() { 
    $("body").delegate(".frmModifierClientData", "click", function (e) { 
        var code_client = $(this).data("client");
        console.log(code_client);
       
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'frm_modal_modifier_client',
                codeClient: code_client
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#btnSubmitForm", "Traitement...");

            },
            success: function(data) {
                btnRes("#btnSubmitForm", 'Enregistrer le client', 'fa-save');
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#client-modal").modal("show");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    }
    );
}

bUpdateClient();
function bUpdateClient() {
    $("body").delegate("#frmUpdateClientData", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();


        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $(".loader_backdrop2").css('display', "block");
                
                btnReq(".modal_footer", "Mise à jour en cours...");
            },
            success: function(data) {
                console.log(data);
                $(".loader_backdrop2").css('display', "none");

                btnRes(".modal_footer", "Mettre à jour le client", "fa-edit");
                if (data.code == 200) {
                    tables['data-table-client'].ajax.reload(null, false);
                    $.notify(data.message, "success");
                    $("#client-modal").modal("hide");

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}

/** FIN SECTION CLIENT */



