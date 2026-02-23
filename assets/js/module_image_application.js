// ==========================================
// Images Application - Fonctions spécifiques
// ==========================================
// Ouverture modal ajout image application
openModalAddImageApplication();

function openModalAddImageApplication() {
    $('#ImageApplicationAddModal').click(function(e) {
        e.preventDefault();
        
        // Récupérer le code application depuis le data attribute du bouton
        var code_application = $(this).data('code-application');
        // console.log(code_application);
        
        if (!code_application) {
            $.notify("Erreur: Impossible de récupérer l'ID de l'application", "error");
            return;
        }

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_showmodal_image_application',
                code_application: code_application
            },
            dataType: "json",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                btnReq("#ImageApplicationAddModal", "Traitement...");
            },
            success: function(data) {
                
                btnRes("#ImageApplicationAddModal"); 
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $(".data-modal").html(data.data);
                    $("#image_application-modal").modal("show");
                } else {
                    $.notify(data.message || "Erreur lors du chargement", "error");
                }
            }
        })
    });
}

// Soumission formulaire ajout image AVEC fichier
ajouterImageApplication();

function ajouterImageApplication() {
    $("body").delegate("#frmAddImageApplication", "submit", function(e) {
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
                btnReq("#btn_ajouter_image_application", "Enregistrement...");
            },
            success: function(data) {
                btnRes("#btn_ajouter_image_application");
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $.notify(data.message, "success");
                    $("#image_application-modal").modal("hide");
                    // Recharger la page pour afficher la nouvelle image
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $.notify(data.message, "error");
                }
            },
            error: function(xhr, status, error) {
                btnRes("#btn_ajouter_image_application");
                $(".loader_backdrop2").css('display', "none");
                $.notify("Erreur lors de l'enregistrement: " + error, "error");
            }
        })
    });
}

// Suppression image application
aSupprimerImageApplication();

function aSupprimerImageApplication() {
    $("body").delegate(".imageApplicationDelete", "click", function(e) {
        e.preventDefault();
        var code = $(this).data("imageapplication");
        var id = $(this).attr("id");

        swal({
            title: "Êtes vous sûr ?",
            text: "Cette image sera définitivement supprimée",
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
                        action: 'supprimer_image_application',
                        id_image: code
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
                            $.notify(data.message, "success");
                            // Recharger la page pour mettre à jour la liste
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            $.notify(data.message, "error");
                        }
                    }
                })
            }
        })
    });
}

// Lightbox - Ouvrir l'image en grand
aOpenLightbox();

function aOpenLightbox() {
    $("body").delegate(".img-lightbox", "click", function(e) {
        e.preventDefault();
        var fullImage = $(this).data('full-image');
        $("#lightboxImage").attr('src', fullImage);
        $("#imageLightboxModal").modal('show');
    });
}
