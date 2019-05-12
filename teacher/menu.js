$(function () {
    ShowUser();
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
})
function ShowUser() {
    $('#list-Teacher').append(`<div class="row student-data">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><p id="teacher-name">Ver perfil</p></div>
                    <div class="col-sm-3"><p id="teacher-name">Nombre de Usuario</p></div>
                    <div class="col-sm-2"><p> Sala que perteneces</p></div>
                    <div class="col-sm-2"></div>
                    </div>`)
    $.ajax({
        url: 'php/allTeacher.php',
        method: "get",
        dataType: "json",
        success: function (datos) {
            console.log(datos)
            for (i = 0; i < datos.length; i++) {
                if (datos[i].user != user){
                    $('#list-Teacher').append(`<div class="row student-data"> 
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><a href="#" onclick="profileUser('`+datos[i].user+ `')"  id="profile`+ datos[i].id + `">Ver perfil</a></div>
                    <div class="col-sm-3"><p id="teacher-name">`+ datos[i].user + `</p></div>
                    <div class="col-sm-2"><p>`+ datos[i].sala+`</p></div>
                    <div class="col-sm-2"><button onclick="ChangeChat('`+datos[i].sala+`')" id="`+ datos[i].id + `">Chatear!</button></div>
                    </div>`)
                }
                    
            }
        }
    });
}


//profile/profile.php?userProfile=Juan
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
function ChangeChat(salachat){
    console.log(user)
    $.ajax({
        url: 'php/changeChat.php',
        method: "post",
        data: { chat: salachat, nameUser : user },
        success: function (datos) {
            console.log(datos)
        }
    });
    location.reload();

}
function RegistroAjax() {
    $.ajax({
        url: 'php/loginStudentdb.php',
        method: "post",
        data: { usuario: $('[name="user"]').val(), pass: $('[name="pass"]').val(), email: $('[name="email"]').val(),  language: $('[name="language"]').val(), sala: sala  },
        success: function (datos) {
            console.log(datos)
            if (datos == "true") {
                
                $("#input-error").html("")
                var inputs = document.getElementById('frm-show').getElementsByTagName('input');
                value = true;
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].value = "";
                };
                $("#input-error").html(`<div class="alert alert-success">
                <strong>Felicidades!!</strong>Usuario registrado con éxito
                </div>`)

            }
            else {
                $("#frm-show").html("Actualmente hay un error en el sistema porfavor intentelo de nuevo mas tarde");
            }
        }
    });
}

function profileUser(name){
    $.ajax({
        url: 'php/allTeacher.php',
        method: "post",
        data: { nameUser : name },
        success: function (datos) {
            if(datos == "Ready"){
                location.href ="profile/profile.php";
            }
            // else{
            //     if(datos == "Private"){
                    
            //     }
            // }
        }
    });
}