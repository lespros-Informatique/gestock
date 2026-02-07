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
            // dataType: 'JSON',
            

            beforeSend: function () {
                $("#btn_login").html(
                    '<i class="fa fa-refresh fa-spin fa-2x"></i> &nbsp; Connexion...'
                );
                $("#btn_login").attr("disabled", "disabled");
            },
            success: function (data) {
                
                console.log(data);
                
                $("#btn_login").html(
                    '<i class="fa fa-check-circle"></i> &nbsp; Connexion'
                );
                $("#btn_login").attr("disabled", false);

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
