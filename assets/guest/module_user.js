// alert("Hello world!");
// ## SEXION CONNEXION
btnLoginUser();

function btnLoginUser() {
    $("body").delegate("#frmLogin", "submit", function (e) {
        e.preventDefault();
        var form = $(this).serialize();
        
        $.ajax({
            url: URL_AJAX,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            
            beforeSend: function () {
                btnReq("#btnSubmitForm", "Connexion...");
            },
            success: function (data) {
                
                console.log(data);
                btnRes("#btnSubmitForm", "Connexion",'fa-log-in');

                if (data.code === 200) {
                    // setAcademicYear();
                    localStorage.setItem('data-year',data.activityYear);


                    swal("Notification", data.msg,"success").then(() => {
                        window.location.href = URL_HOME;
                    });

                } else {
                    $.notify(data.msg, "error",);
                }
            }
        });
    });
}

loadDataTable('data-table-user', '#data-table-user', 'bcharger_data_users');



// searchUser();
function searchUser() {
    $("body").delegate($('#data-table-user').DataTable().search(), "keyup", function(e) {
        e.preventDefault();
        var search = $('input[type="search"]').val();
       
        testDatable('bcharger_data_users','#data-table-user',search)
        // loadDataTable('data-table-user', '#data-table-user', 'bcharger_data_users');
    });
}

searchUser();

// EMPLOYE
// Show modal add USER
modalAddUser();

function modalAddUser() {
    $("body").delegate(".btn_modal_user", "click", function(e) {
        e.preventDefault();
      
        $.ajax({
            url: URL_AJAX,
            method: 'POST',
            data: {
                action: "frm_modal_user"
            },
            dataType: 'JSON',
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
            },
            success: function(data) {
                console.log(data);
                $(".loader_backdrop2").css('display', "none");
                if (data.code == 200) {
                    $('.data-modal').html(data.data);
                    $("#user-modal").modal("show");
                }else{
                    $.notify(data.message, "error");
                }
            }
        });

    });
}

btnAddUser();

function btnAddUser() {
    $("body").delegate("#frmAddUser", "submit", function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: data,
            dataType: "JSON",
            beforeSend: function () {
                $(".loader_backdrop2").css('display', "block");
                btnReq(".modal_footer", "Enregistrement...");
            },
            success: function (data) {
                console.log(data);
                $(".loader_backdrop2").css('display', "none");
                btnRes(".modal_footer", "Enregistrer", "fa-save");
                // return
                if (data.code == 200) {
                    $.notify(data.message, "success");
                    tables['data-table-user'].ajax.reload(null, false);
                    $("#user-modal").modal("hide");
                } else {
                    $.notify(data.message, "error");
                }
            }
        });
    });
}

disableUser();

function disableUser() {
    $("body").delegate(".btn_disable_user", "click", function(e) {
        e.preventDefault();
        var id = $(this).data("user");
        
        
        swal({
            title: "Êtes vous sûr ?",
            text: "De vouloir desactiver ce compte?",
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
                        action: 'btn_disable_user',
                        id_user: id
                    },
                    dataType: "json",
                    beforeSend: function() {
                        
                        $(".loader_backdrop2").css('display', "block");
                    },
                    success: function(data) {
                        ;

                        if (data.code == 200) {
                            resetDataTable();
                            $.notify(data.message, 'success');
                            $("#sexion_user").load(" #sexion_user > *");
                            setTimeout(initDataTable, 200);
                            $(".loader_backdrop2").css('display', "none");
                        } else {
                            $.notify(data.message)
                        }
                    }
                })
            }

        })


    });
}

enableUser();

function enableUser() {
    $("body").delegate(".btn_enable_user", "click", function(e) {
        e.preventDefault();
        var id = $(this).data("user");
        
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_enable_user',
                id_user: id
            },
            dataType: "json",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
            },
            success: function(data) {
                ;

                if (data.code == 200) {
                    resetDataTable();
                    $.notify(data.message, 'success')
                    $("#sexion_user").load(" #sexion_user > *");
                    setTimeout(initDataTable, 200);
                    $(".loader_backdrop2").css('display', "none");
                } else {
                    $.notify(data.message)
                }
            }
        });


    });
}

renvoyerMail();

function renvoyerMail() {
    $("body").delegate(".btn_send_mail", "click", function(e) {
        e.preventDefault();
        var id = $(this).data("user");
        
        
        $.ajax({
            method: "POST",
            url: URL_AJAX,
            data: {
                action: 'btn_send_mail_activation',
                id_user: id
            },
            dataType: "json",
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
            },
            success: function(data) {
                ;

                if (data.code == 200) {
                    resetDataTable();
                    $.notify(data.message, 'success')
                    $("#sexion_user").load(" #sexion_user > *");
                    setTimeout(initDataTable, 200);
                    $(".loader_backdrop2").css('display', "none");
                } else {
                    $.notify(data.message)
                }
            }
        });


    });
}



btnRegisterUser();
function btnRegisterUser() {
    $("body").delegate("#frmRegister", "submit", function (e) {
        e.preventDefault();
        var form = $(this).serialize();
        
        $.ajax({
            url: URL_AJAX,
            method: 'POST',
            data: form,
            dataType: 'JSON',

            beforeSend: function () {

                $("#btn_register").html(
                    '<i class="fa fa-refresh fa-spin fa-2x"></i> &nbsp; Connexion...'
                );
                $("#btn_register").attr("disabled", "disabled");
            },
            success: function (data) {
                console.log(data);
                
                
                $("#btn_register").html(
                    '<i class="fa fa-check-circle"></i> &nbsp; Connexion'
                );
                $("#btn_register").attr("disabled", false);

                if (data.code === 200) {
                    $("#frmRegister input").val("");
                    swal("Notification", data.message,"success");
                    // reset form 
                    

                } else {
                    $.notify(data.message, "error",);
                }
            }
        });
    });
}
