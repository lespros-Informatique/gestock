const URLS = window.origin;
const URL_HOME = URLS + "/gestock/";
const URL_AJAX = URL_HOME + "src/controllers/ajx.php";








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
                
                // btnReq("#btn_ajouter_categorie", "Enregistrement...");
            },
            success: function(data) {
                console.log(data);
                    $(".loader_backdrop2").css('display', "none");

                // btnRes("#btn_ajouter_categorie");
                if (data.code == 200) {
                    // resetDataTable();
                    $.notify(data.message, "success");
                    $("#client-modal").modal("hide");
                    $("#section_client").load(" #section_client > *");
                    setTimeout(function () {
                        initDataTable();
                        // $("#frmAddClientData")[0].reset();
                    }, 1000);
                    // setInterval(initDataTable, 120);

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}

