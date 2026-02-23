const URLS = window.origin;
const URL_HOME = URLS + "/admin-smartcode/";
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


function testDatable(action, search) {
    $.ajax({
        method: "POST",
        url: URL_AJAX,
        data: {
            action: action,
            length: 10,
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
            console.log(data);

        }
    });
}
function loadDataTable(tableId,selector,action) {


    if ($(selector + ':visible').length) {
// console.log(selector,tableId,action);

        // testDatable(action, selector);return;
        
      tables[tableId] = $(selector).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": URL_AJAX,
            "type": "POST",
            "data": {
                action: action
            }
            // ,
            // dataType:'text'
            // ,
            // success:function(params) {
            //     console.log(params);
                
            // }
        }
    });
    }
}


/**
 * Fonction générique de suppression
 * @param {Object} params - Paramètres de configuration
 * @param {string} params.deleteClass - Classe du bouton de suppression (ex: ".categorieDelete")
 * @param {string} params.dataAttribute - Nom de l'attribut data (ex: "categorie")
 * @param {string} params.actionDelete - Action AJAX pour la suppression (ex: "btn_delete_categorie")
 * @param {string} params.codeParam - Nom du paramètre code envoyé (ex: "code_categorie")
 * @param {string} params.tableId - ID de la table DataTable (ex: "data-table-categorie")
 * @param {string} params.title - Titre du swal (optionnel)
 * @param {string} params.text - Texte du swal (optionnel)
 */
function Supprimer(params) {
    var config = $.extend({
        title: "Êtes vous sûr ?",
        text: "Cela entrainera la suppression de plusieurs données"
    }, params);

    $("body").delegate(config.deleteClass, "click", function(e) {
        e.preventDefault();
        var code = $(this).data(config.dataAttribute);
        var id = $(this).attr("id");

        swal({
            title: config.title,
            text: config.text,
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
                        action: config.actionDelete,
                        [config.codeParam]: code
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $(".loader_backdrop2").css('display', "block");
                        btnReq("#" + id, "Traitement...");

                    },
                    success: function(data) {
                        
                        $(".loader_backdrop2").css('display', "none");
                        btnRes("#" + id, 'Supprimer', 'fa-trash');
                        if (data.code == 200) {
                            if (config.tableId && tables[config.tableId]) {
                                tables[config.tableId].ajax.reload(null, false);
                            }
                            $.notify(data.message, "success");
                        

                        } else {
                            $.notify(data.message, "error");
                        }
                    }
                })
            }

        })


    });
}


/**
 * Fonction générique pour ouvrir le modal de modification
 * @param {Object} params - Paramètres de configuration
 * @param {string} params.updateClass - Classe du bouton de modification (ex: ".frmModifierCategorie")
 * @param {string} params.dataAttribute - Nom de l'attribut data (ex: "categorie")
 * @param {string} params.actionUpdate - Action AJAX pour le modal de modification (ex: "modal_modifier_categorie")
 * @param {string} params.modalId - ID du modal (ex: "#categorie-modal")
 */
function OpenModalUpdate(params) {
    var config = $.extend({
        dataAttribute: "id"
    }, params);

    $("body").delegate(config.updateClass, "click", function(e) {
        e.preventDefault();
        var code = $(this).data(config.dataAttribute);
        var id = $(this).attr("id");

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: config.actionUpdate,
                code: code
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#" + id, "Traitement...");

            },
            success: function(data) {
                
                btnRes(id, 'Modifier', 'fa-edit');
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $(config.modalId).modal("show");
                } else {
                    $.notify("Erreur lors du traitement", "error");
                }

            }
        })
    });
}


/**
 * Fonction générique pour ouvrir le modal d'ajout
 * @param {Object} params - Paramètres de configuration
 * @param {string} params.addBtnId - ID du bouton d'ajout (ex: "#categorieAddModal")
 * @param {string} params.actionAdd - Action AJAX pour afficher le modal d'ajout (ex: "btn_showmodal_categorie")
 * @param {string} params.modalId - ID du modal (ex: "#categorie-modal")
 */

function OpenModalAdd(params) {
    var config = params;

    $(config.addBtnId).click(function(e) {
        e.preventDefault();
        

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: config.actionAdd
            },
            dataType: "JSON",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq(config.addBtnId, "Traitement...");

            },
            success: function(data) {
                console.log(data);
                
                btnRes(config.addBtnId);

                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $(config.modalId).modal("show");

                }

            }
        })
    });
}


/**
 * Fonction générique pour l'ajout/modification via formulaire
 * @param {Object} params - Paramètres de configuration
 * @param {string} params.formId - ID du formulaire (ex: "#frmAddCategorie")
 * @param {string} params.submitBtnId - ID du bouton de soumission (ex: "#btn_ajouter_categorie")
 * @param {string} params.tableId - ID de la table DataTable (ex: "data-table-categorie")
 * @param {string} params.modalId - ID du modal à fermer (ex: "#categorie-modal")
 */
function Ajouter(params) {
    var config = params;

    $("body").delegate(config.formId, "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "json",
            beforeSend: function() {
                btnReq(config.submitBtnId, "Enregistrement...");
            },
            success: function(data) {
                
                
                btnRes(config.submitBtnId);
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    if (config.tableId && tables[config.tableId]) {
                        tables[config.tableId].ajax.reload(null, false);
                    }
                    $.notify(data.message, "success");
                    if (config.modalId) {
                        $(config.modalId).modal("hide");
                    }

                } else {
                    $.notify(data.message);
                }
            }
        })
    });
}


/**
 * Fonction générique pour l'ajout/modification via formulaire avec upload de fichiers
 * @param {Object} params - Paramètres de configuration
 * @param {string} params.formId - ID du formulaire (ex: "#frmAddApplication")
 * @param {string} params.submitBtnId - ID du bouton de soumission (ex: "#btn_ajouter_application")
 * @param {string} params.tableId - ID de la table DataTable (ex: "data-table-application")
 * @param {string} params.modalId - ID du modal à fermer (ex: "#application-modal")
 */
function AjouterAvecFichier(params) {
    var config = params;

    $("body").delegate(config.formId, "submit", function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                btnReq(config.submitBtnId, "Enregistrement...");
            },
            success: function(data) {
                // console.log(data);return;

                btnRes(config.submitBtnId);
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    if (config.tableId && tables[config.tableId]) {
                        tables[config.tableId].ajax.reload(null, false);
                    }
                    $.notify(data.message, "success");
                    if (config.modalId) {
                        $(config.modalId).modal("hide");
                    }
                } else {
                    $.notify(data.message, "error");
                }
            },
            error: function(xhr, status, error) {
                btnRes(config.submitBtnId);
                $(".loader_backdrop2").css('display', "none");
                $.notify("Erreur lors de l'enregistrement: " + error, "error");
            }
        })
    });
}

