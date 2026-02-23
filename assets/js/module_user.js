// Chargement DataTable
loadDataTable('data-table-user', '#data-table-user', 'charger_data_user');

// searchUser();
function searchUser() {
    $("body").delegate($('#data-table-user').DataTable().search(), "keyup", function(e) {
        e.preventDefault();
        var search = $('input[type="search"]').val();
       
        testDatable('charger_data_user',search)
        // loadDataTable('data-table-user', '#data-table-user', 'bcharger_data_users');
    });
}

deconnecter();

function deconnecter() {
    
    $('.btn_deconnect').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: URL_AJAX,
            method: 'POST',
            dataType: "JSON",
            data: {
                action: "btn_user_Deconnect"
            },
            beforeSend: function() {
                $(".loader_backdrop2").css('display', "block");
                // $("#spinner").addClass("show");
                // $("#btn_add_user").html(
                //     '<i class="fa fa-refresh fa-spin fa-2x"></i> &nbsp; Enregistrement...'
                // );
                // $("#btn_add_user").attr("disabled", "disabled");
            },
            success: function(data) {
                $("#spinner").removeClass("show");
                if (data.code == 200) {
                    history.go(0);
                }
            }
        })
    });
}

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
                btnReq("btn_login","Connexion...");
            },
            success: function (data) {
                console.log(data);
                btnRes("btn_login","Connexion");

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
            },
            // error:function
        });
    });
}


btnResetPassword();
function btnResetPassword() {
    $("body").delegate("#frmResetPassword", "submit", function (e) {
        e.preventDefault();
        var form = $(this).serialize();
        
        $.ajax({
            url: URL_AJAX,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            
            beforeSend: function () {

                $("#btn_reset_password").html(
                    '<i class="fa fa-refresh fa-spin fa-2x"></i> &nbsp; Connexion...'
                );
                $("#btn_reset_password").attr("disabled", "disabled");
            },
            success: function (data) {
                
                $("#btn_reset_password").html(
                    '<i class="fa fa-check-circle"></i> &nbsp; Connexion'
                );
                $("#btn_reset_password").attr("disabled", false);

                if (data.code === 200) {
                    // setAcademicYear();
                    swal("Notification", data.msg,"success")
                    $("#frmResetPassword input").val("");

                } else {
                    $.notify(data.msg, "error",);
                }
            }
        });
    });
}

showAndHidePassword();

function showAndHidePassword() {
    $('body').on('click', '#show-password', function (e) {
        if ($(this).prop('checked')) {
            $('.password').prop('type', 'text');
        } else {
            $('.password').prop('type', 'password');
            
        }

    });
}


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
