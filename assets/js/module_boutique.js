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


function testDatable(action, selector) {
    $.ajax({
        method: "POST",
        url: URL_AJAX,
        data: {
            action: action,
            length: 2,
            start: 2,
            search: $(selector).DataTable().search().value,
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

        // testDatable(action, selector);

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





/** DEBUT SECTION BOUTIQUE */

loadDataTable('data-table-boutique', '#data-table-boutique', 'bcharger_data_boutiques');

bopenModalAddBoutique();
function bopenModalAddBoutique() {
    $('#BoutiqueAddModal').click(function (e) {
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_boutique_add'
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
                    $("#boutique-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");


                }

            }
        })
    });
}

bAjouterBoutique();
function bAjouterBoutique() {
    $("body").delegate("#frmAddBoutiqueData", "submit", function(e) {
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

                btnRes(".modal_footer", "Ajouter le boutique", "fa-save");
                if (data.code == 200) {
                    tables['data-table-boutique'].ajax.reload(null, false);
                    $.notify(data.message, "success");
                    $("#boutique-modal").modal("hide");
                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}

bOpenModalUpdateBoutique();
function bOpenModalUpdateBoutique() { 
    $("body").delegate(".frmModifierBoutiqueData", "click", function (e) { 
        var code_boutique = $(this).data("boutique");
        console.log(code_boutique);
       
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'frm_modal_modifier_boutique',
                codeBoutique: code_boutique
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                // btnReq(".modal_footer", "Traitement...");

            },
            success: function(data) {
                // btnRes(".modal_footer", 'Enregistrer le fournisseur', 'fa-save');
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#boutique-modal").modal("show");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    }
    );
}

bUpdateBoutique();
function bUpdateBoutique() {
    $("body").delegate("#frmUpdateBoutiqueData", "submit", function(e) {
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

                btnRes(".modal_footer", "Mettre à jour le boutique", "fa-edit");
                if (data.code == 200) {
                    tables['data-table-boutique'].ajax.reload(null, false);
                    $.notify(data.message, "success");
                    $("#boutique-modal").modal("hide");

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}

/** FIN SECTION CLIENT */



