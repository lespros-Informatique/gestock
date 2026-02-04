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
