loadDataTable('data-table-categorie', '#data-table-categorie', 'bcharger_data_categories');

aSupprimer_categorie();

function aSupprimer_categorie() {
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

aOpenModalUpdateCategorie();

function aOpenModalUpdateCategorie() {
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
aOpenModalAddCategorie();

function aOpenModalAddCategorie() {
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


aAjouter_categorie();
function aAjouter_categorie() {
    $("body").delegate("#frmAddCategorie", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function() {
                btnReq("#btn_ajouter_categorie", "Enregistrement...");
            },
            success: function(data) {
                
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


// mark

aSupprimer_mark();
function aSupprimer_mark() {
    $("body").delegate(".markDeleteMark", "click", function(e) {
        e.preventDefault();
        var code = $(this).data("mark");
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
                        action: 'btn_delete_mark',
                        code_mark: code
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
                            $("#sexion_mark").load(" #sexion_mark > *");
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

aOpenModalUpdateMark();

function aOpenModalUpdateMark() {
    $("body").delegate(".frmModifierMark", "click", function(e) {
        e.preventDefault();
        var code_mark = $(this).data("mark");
        var id = $(this).attr("id");

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'modal_modifier_mark',
                code: code_mark
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
                    $("#mark-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    });
}

aOpenModalAddmark();

function aOpenModalAddmark() {
    $('#markAddModal').click(function(e) {
        e.preventDefault();
        

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_mark'
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#markAddModal", "Traitement...");

            },
            success: function(data) {

                btnRes("#markAddModal");
                ;

                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#mark-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");


                }

            }
        })
    });
}


aAjouter_mark();
function aAjouter_mark() {
    $("body").delegate("#frmAddMark", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function() {
                btnReq("#btn_ajouter_mark", "Enregistrement...");
            },
            success: function(data) {
                
                btnRes("#btn_ajouter_mark");
                if (data.code == 200) {
                    // resetDataTable();
                    $.notify(data.message, "success");
                    $("#mark-modal").modal("hide");
                    $("#sexion_mark").load(" #sexion_mark > *");
                    // setInterval(initDataTable, 120);

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}
// FIN mark
// unite

aSupprimer_unite();
function aSupprimer_unite() {
    $("body").delegate(".uniteDeleteUnite", "click", function(e) {
        e.preventDefault();
        var code = $(this).data("unite");
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
                        action: 'btn_delete_unite',
                        code_unite: code
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
                            $("#sexion_unite").load(" #sexion_unite > *");
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

aOpenModalUpdateUnite();

function aOpenModalUpdateUnite() {
    $("body").delegate(".frmModifierUnite", "click", function(e) {
        e.preventDefault();
        var code_unite = $(this).data("unite");
        var id = $(this).attr("id");

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'modal_modifier_unite',
                code: code_unite
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
                    $("#unite-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    });
}

aOpenModalAddUnite();

function aOpenModalAddUnite() {
    $('#uniteAddModal').click(function(e) {
        e.preventDefault();
        

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_unite'
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#uniteAddModal", "Traitement...");

            },
            success: function(data) {

                btnRes("#uniteAddModal");
                ;

                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#unite-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");


                }

            }
        })
    });
}


aAjouter_unite();
function aAjouter_unite() {
    $("body").delegate("#frmAddUnite", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function() {
                btnReq("#btn_ajouter_unite", "Enregistrement...");
            },
            success: function(data) {
                
                btnRes("#btn_ajouter_unite");
                if (data.code == 200) {
                    // resetDataTable();
                    $.notify(data.message, "success");
                    $("#unite-modal").modal("hide");
                    $("#sexion_unite").load(" #sexion_unite > *");
                    // setInterval(initDataTable, 120);

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}
// FIN unite


aSupprimer_produit();

function aSupprimer_produit() {
    $("body").delegate(".produitDeleteProduit", "click", function(e) {
        e.preventDefault();
        var code = $(this).data("produit");
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
                        action: 'btn_delete_produit',
                        code_produit: code
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
                            $("#sexion_produit").load(" #sexion_produit > *");
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

// aOpenModalUpdateProduit();

function aOpenModalUPdateproduit() {
    $("body").delegate(".frmModifierProduit", "click", function(e) {
        e.preventDefault();
        var code_produit = $(this).data("produit");
        var id = $(this).attr("id");
        // alert("" + id + "");return false;
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'modal_modifier_produit',
                code: code_produit
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
                    $("#produit-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    });
}


// produit
aOpenModalAddProduit();
function aOpenModalAddProduit() {
    $('#produitAddModal').click(function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_produit'
            },
            // dataType: "JSON",
            beforeSend: function() {                
                $(".loader_backdrop2").css('display', "block");
                btnReq("#produitAddModal", "Traitement...");

            },
            success: function(data) {
                console.log(data);

                btnRes("#produitAddModal");
                ;

                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#produit-modal").modal("show");
                    $(".loader_backdrop2").css('display', "none");


                }

            }
        })
    });
}


aAjouter_produit();
function aAjouter_produit() {
    $("body").delegate("#frmAddProduit", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function() {
                btnReq("#btn_ajouter_produit", "Enregistrement...");
            },
            success: function(data) {
                
                btnRes("#btn_ajouter_produit");
                if (data.code == 200) {
                    // resetDataTable();
                    $.notify(data.message, "success");
                    $("#produit-modal").modal("hide");
                    $("#sexion_produit").load(" #sexion_produit > *");
                    // setInterval(initDataTable, 120);

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}
// FIN produit

