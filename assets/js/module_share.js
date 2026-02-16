const URLS = window.origin;
const URL_HOME = URLS + "/gestock/";
const URL_AJAX = URL_HOME + "src/controllers/ajx.php";
// const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
let tables = {};
let schopIdentity = "";

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


function testDatable(action, selector,search = "") {
    // var se = $(selector).DataTable().search().value;
    $.ajax({
        method: "POST",
        url: URL_AJAX,
        data: {
            action: action,
            length: 20,
            start: 1,
            search: search,
            draw: 1
        },
        // dataType: "JSON",
        beforeSend: function () {
            // $(".loader_backdrop2").css('display', "block");
            // btnReq("#" + id, "Traitement...");
        },
        success: function (data) {
            console.log("test", data);

        }
    });
}



function loadDataTable(tableId,selector,action) {


    if ($(selector + ':visible').length) {
console.log(selector,tableId,action);

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



    getShopIdentity()

function getShopIdentity() {
    shopIdentity = localStorage.getItem("data-shop");
    $("#shopIdentity").text(shopIdentity);

}

function setShopIdentity() {

    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            action: 'get_shop_identity'
        },
        dataType: 'JSON',
        success: function (data) {
            console.log(data)

            if (data.code === 200) {
                shopIdentity = data.data;
                localStorage.setItem("data-shop", data.data);
                $("#shopIdentity").text(shopIdentity);
            }
        }
    });
}

activeStatutAnnee();

function activeStatutAnnee() {
    $("body").delegate(".btn_active_annee", "click", function (e) {
        e.preventDefault();

        var code = $(this).data("code");
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_active_annee',
                code_annee: code
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
                

                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                     setSchopIdentity();
                    sAlert("Notification", data.data, "success");


                }

            }
        });

    });
}

desactiveStatutAnnee();

function desactiveStatutAnnee() {
    $("body").delegate(".btn_desactive_annee", "click", function (e) {
        e.preventDefault();

        var code = $(this).data("code");

         $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_desactive_annee',
                code_annee: code
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
                

                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                     setSchopIdentity();
                    sAlert("Notification", data.data, "success");


                }

            }
        });

    });
}