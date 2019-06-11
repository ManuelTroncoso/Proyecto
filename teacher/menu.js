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

    $('#createChat').click(function () {
        if ($("#name-chat").val() != "") {
            if ($('#private').prop('checked')) {
                CreateChat($("#name-chat").val(), "1");
            }
            else {
                CreateChat($("#name-chat").val(), "0");

            }
        }
    })
})
function ShowUser() {
    $.ajax({
        url: 'php/allTeacher.php',
        method: "get",
        dataType: "json",
        success: function (datos) {
            console.log(datos)
            for (i = 0; i < datos.length; i++) {
                if (datos[i].user != user) {
                    sala = datos[i].sala==null? '-': datos[i].sala;
                    $('#list-Teacher').append(`<div class="row student-data"> 
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><a href="#" onclick="profileUser('`+ datos[i].user + `')"  id="profile` + datos[i].id + `">Ver perfil</a></div>
                    <div class="col-sm-3"><p id="teacher-name">`+ datos[i].user + `</p></div>
                    <div class="col-sm-2"><p>`+ sala + `</p></div>
                    <div class="col-sm-2"><button onclick="ChangeChat('`+ datos[i].sala + `')" id="` + datos[i].id + `">Cambiar de sala</button></div>
                    </div>`)
                    sala == '-' ? $('#'+datos[i].id).attr("disabled", true):$('#'+datos[i].id).attr("disabled", false); 
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
function ChangeChat(salachat) {
    console.log(user)
    $.ajax({
        url: 'php/changeChat.php',
        method: "post",
        data: { chat: salachat, nameUser: user },
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
        data: { usuario: $('[name="user"]').val(), idTeacher: id,pass: $('[name="pass"]').val(), email: $('[name="email"]').val(), language: $('[name="language"]').val(), sala: sala },
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

function profileUser(name) {
    $.ajax({
        url: 'php/allTeacher.php',
        method: "post",
        data: { nameUser: name },
        success: function (datos) {
            if (datos == "Ready") {
                location.href = "profile/profile.php?userProfile="+name;
            }
            // else{
            //     if(datos == "Private"){

            //     }
            // }
        }
    });
}
function CreateChat(nameSala, privateSala) {
    $.ajax({
        url: '../Chat/addChat.php',
        method: "post",
        data: { sala: nameSala, private: privateSala, userName: user },
        success: function (datos) {
            location.reload(true);
            // location.href = "../Chat/index.php";
        }
    });
}
function Search() {

    var sSearch = $("#search").val(),
        sSearchNew = sSearch.trim();

    $('#list-Teacher').html("");
    if (sSearchNew != "") {
        $("#filter-name").text(sSearchNew);
        $("#filter-name").append('<button class="btn btn-link" onclick="clearLink()"> Eliminar Filtros</button>')
        $.ajax({
            url: 'php/search.php',
            method: "post",
            data: { nameUser: sSearchNew },
            success: function (datos) {
                datos = JSON.parse(datos);
                for (i = 0; i < datos.length; i++) {
                    if (datos[i].user != user) {
                        $('#list-Teacher').append(`<div class="row student-data"> 
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2"><a href="#" onclick="profileUser('`+ datos[i].user + `')"  id="profile` + datos[i].id + `">Ver perfil</a></div>
                            <div class="col-sm-3"><p id="teacher-name">`+ datos[i].user + `</p></div>
                            <div class="col-sm-2"><p>`+ datos[i].sala + `</p></div>
                            <div class="col-sm-2"><button onclick="ChangeChat('`+ datos[i].sala + `')" id="` + datos[i].id + `">Cambiar de sala</button></div>
                            </div>`)
                    }

                }
            }
        });
    }
    else {
        $("#filter-name").text("No hay ninguna busqueda actualmente");
        ShowUser();
    }
}
function clearLink() {
    $("#search").val("");
    $("#filter-name").text("No hay ninguna busqueda actualmente");
    ShowUser();
}
function ShowStudentDelete(){
    $("#delete-user").html('<div class="col-sm-2"></div><div class="col-sm-6"><p id="name-student">Nombre del alumno</p></div><div class="col-sm-4"><p >Borrar</p></div>');
    $.ajax({
        url: 'php/loadStudent.php',
        method: "post",
        data: { user: user },
        dataType: "json",
        success: function (datos) {
            for(i=0; i<datos.length;i++){
                $("#delete-user").append(
                    '<div class="col-sm-2">q</div><div class="col-sm-6"><p id="name-student">'+datos[i].user+'</p></div>'+
                        `<div class="col-sm-4"><button onclick="DeleteStudent('`+datos[i].user+`')">Borrar</button></div>`)
            }
            //console.log(datos)
        }
    });
    
}
function DeleteStudent(nameStudent){
    $.ajax({
        url: 'php/deleteStudent.php',
        method: "post",
        data: { name: nameStudent },
        success: function (datos) {
            if(datos==""){
                ShowStudentDelete();
            }
        }
    });
    
}
