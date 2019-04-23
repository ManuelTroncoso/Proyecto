$(function () {
    $("#ok").click(function () {
        if (Comprueba()) {
            if (password()) {
                RegistroAjax();
            } else {
                $("#input-error").html(`<div class="alert alert-danger">
                        <strong>Error!</strong> Las contraseñas no coinciden
                    </div>`)
            }

        }
        else {
            $("#input-error").html(`<div class="alert alert-danger">
            <strong>Error!</strong> Por favor, rellene todos los campos
          </div>`)
        }
        //Sino mensaje de que rellene todos los datos

    });
    ShowUser();
})
function Comprueba() {
    $("#input-error").html("")
    var inputs = document.getElementById('frm-show').getElementsByTagName('input');
    value = true;
    for (let i = 0; i < inputs.length; i++) {
        value = inputs[i].value != "";
        if (!value) {
            return false;
        }
    };
    return true;
}
function password() {
    if ($('[name="repeatpass"]').val() == $('[name="pass"]').val()) {
        return true;
    }
}

function RegistroAjax() {
    $.ajax({
        url: 'php/loginStudentdb.php',
        method: "post",
        data: { usuario: $('[name="user"]').val(), pass: $('[name="pass"]').val(), email: $('[name="email"]').val() },
        success: function (datos) {
            if (datos == "true") {
                $("#frm-show").html("Usuario registrado, compruebe su correo electronico");
            }
            else {
                $("#frm-show").html("Actualmente hay un error en el sistema porfavor intentelo de nuevo mas tarde");
            }
        }
    });
}

function ShowUser(){
    $.ajax({
        url: 'php/allStudent.php',
        method: "get",
        dataType: "json",
        success: function (datos) {
            for(i = 0; i<datos.length; i++){
                $('#list-Student').append(`<div class="row student-data">
                <div class="col-sm-2"></div>
                <div class="col-sm-7"><p id="student-name">`+datos[i].user+`</p></div>
                <div class="col-sm-2"><button id="`+datos[i].id+`">Chatear!</button></div>
            </div>`)
            }
        }
    });
}
