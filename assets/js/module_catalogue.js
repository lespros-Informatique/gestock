const URLS = window.origin;
const URL_HOME = URLS + "/gestock/";
const URL_AJAX = URL_HOME + "src/controllers/ajx.php";
moment.locale('fr');

asupprimer_categorie();

function asupprimer_categorie() {
    $("body").delegate(".categorieDeleteCategorie", "click", function(e) {
        e.preventDefault();
        var code = $(this).data("categorie");
        var id = $(this).attr("id");

        swal({
            title: "Êtes vous sûr ?",
            text: "Cela entrainera la suppression de plusieurs données",
            type: "warning",
            buttons: {
                cancel: {
                    visible: true,
                    text: "Annuler",
                    className: 'btn btn-default'
                },
                confirm: {
                    text: 'Confirmer',
                    className: 'btn btn-danger'
                }
            }

        }).then(function(result) {
            if (result) {

                $.ajax({
                    method: "POST",
                    url: URL_AJAX,
                    data: {
                        action: 'btn_delete_categorie',
                        code_categorie: code
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".loader_backdrop2").css('display', "block");
                        btnReq("#" + id, "Traitement...");

                    },
                    success: function(data) {
                        
                        btnRes("#" + id, 'Supprimer', 'fa-trash');
                        if (data.code == 200) {
                            resetDataTable();
                            $.notify(data.message, "success");
                            $("#sexion_categorie").load(" #sexion_categorie > *");
                            $(".loader_backdrop2").css('display', "none");
                            setTimeout(initDataTable, 200);
                        

                        } else {
                            $.notify(data.message, "error");
                        }
                    }
                })
            }

        })


    });
}

aopenModalUpdateCategorie();

function aopenModalUpdateCategorie() {
    $("body").delegate(".frmModifierCategorie", "click", function(e) {
        e.preventDefault();
        var code_categorie = $(this).data("categorie");
        var id = $(this).attr("id");

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'modal_modifier_categorie',
                code: code_categorie
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#" + id, "Traitement...");

            },
            success: function(data) {
                btnRes("#" + id, 'Modifier', 'fa-edit');
                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#categorie-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    });
}


// CATEGORIE
aopenModalAddCategorie();

function aopenModalAddCategorie() {
    $('#categorieAddModal').click(function(e) {
        e.preventDefault();
        

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_categorie'
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#categorieAddModal", "Traitement...");

            },
            success: function(data) {
                btnRes("#categorieAddModal");
                ;

                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#categorie-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");


                }

            }
        })
    });
}


aajouter_categorie();
function aajouter_categorie() {
    $("body").delegate("#frmAddCategorie", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            // dataType: "json",
            beforeSend: function() {
                // btnReq("#btn_ajouter_categorie", "Enregistrement...");
            },
            success: function(data) {
                console.log(data);return;
                
                btnRes("#btn_ajouter_categorie");
                if (data.code == 200) {
                    // resetDataTable();
                    $.notify(data.message, "success");
                    $("#categorie-modal").modal("hide");
                    $("#sexion_categorie").load(" #sexion_categorie > *");
                    // setInterval(initDataTable, 120);

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}
// FIN CATEGORIE

