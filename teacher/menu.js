boolTeacher = true;
$(function () {
    ShowUser(true);
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
function ShowUser(teacher) {
    boolTeacher = teacher;
    hasDate=false;
    $('#list-Teacher').html("");
    $.ajax({
        async:false,
        url: teacher == true?'/teacher/php/allTeacher.php':'/teacher/php/allStudent.php',
        method: "get",
        dataType: "json",
        success: function (datos) {
           // console.log(teacher)
            for (i = 0; i < datos.length; i++) {
                if (datos[i].user != user) {
                    sala = datos[i].sala==null? '-': datos[i].sala;
                    $('#list-Teacher').append(`<div class="row student-data"> 
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2"><p class="text-center"><a href="#" onclick="profileUser('`+ datos[i].user + `',`+teacher+`)"  id="profile` + datos[i].id + `"><img src="../css/icon/ver.svg" width="35px"></a></p></div>
                    <div class="col-sm-3"><p class="text-center p" id="teacher-name">`+ datos[i].user + ` <img src="../css/icon/`+datos[i].language+`.svg" width="16px"></p></div>
                    <div class="col-sm-3"><p class="text-center p">`+ sala + `</p></div>
                    <div class="col-sm-2"><button class="change-sala" onclick="ChangeChat('`+ datos[i].sala + `')" id="` + datos[i].id + `"><img src="../css/icon/bocadillo.svg" width="35px"></button></div>
                    </div>`)
                    sala == '-' ? $('#'+datos[i].id).attr("disabled", true):$('#'+datos[i].id).attr("disabled", false); 
                }
                
            }
            
        }
    });
    HasDate('#list-Teacher');
    
}
function HasDate(x){
    if($(x).html() == ""){
        $('#list-Teacher').append(`<div class="row"><img src="../css/icon/void.svg" width="170px" id="void" alt=""></div>
        <h3 class="text-center">No hay elementos para mostrar</h3>
        <h3 class="text-center">Pruebe mas tarde</h3>`)
    }
}

//profile/profile.php?userProfile=Juan
function Comprueba() {
    $("#input-error").html("")
    var inputs = document.getElementById('frm-show').getElementsByTagName('input');
    value = true;
    for (let i = 0; i < inputs.length; i++) {
        value = inputs[i].value.replace(/ /g, "") != "";
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
        data: { usuario: $('[name="user"]').val().replace(/ /g, ""), idTeacher: id,pass: $('[name="pass"]').val(), email: $('[name="email"]').val(), language: $('[name="language"]').val(), sala: sala },
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
                if(datos == "UserError"){
                    $("#input-error").html("")
                    $("#input-error").html(`<div class="alert alert-danger">
                    <strong>Error!! </strong>El nombre de usuario ya existe
                    </div>`)
                }
                else{
                    $("#frm-show").html("Actualmente hay un error en el sistema, pruebe a recargar la página. Si el problema continua contacte con el administrador de la web");
                }
            }
        }
    });
}

function profileUser(name, teacher = boolTeacher) {
    //console.log(teacher)
    
    $.ajax({
        url: teacher == true ?'php/allTeacher.php': 'php/allStudent.php',
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


function ChangeDateShow(x){
    if(!($("#"+x).hasClass("active"))&& x=='teacher'){
        //ShowUser(true);
        $("#"+x).addClass("btn-link active").removeClass("btn-primary")
        $("#student").removeClass("btn-link active").addClass("btn-primary");
        boolTeacher = true;
        clearLink();
    }
    else{
        if(!($("#"+x).hasClass("active")) && x=='student'){
            //ShowUser(false);
            $("#"+x).addClass("btn-link active").removeClass("btn-primary")
            $("#teacher").removeClass("btn-link active").addClass("btn-primary");
            boolTeacher = false;
            clearLink();
        }
    }

}
function CreateChat(nameSala, privateSala) {
    $.ajax({
        url: '/Chat/addChat.php',
        method: "post",
        data: { sala: nameSala, private: privateSala, userName: user },
        success: function (datos) {
            location.reload(true);
            // location.href = "../Chat/index.php";
        }
    });
}
function Search() {
    console.log(boolTeacher)
    var sSearch = $("#search").val(),
        sSearchNew = sSearch.trim();

    $('#list-Teacher').html("");
    if (sSearchNew != "") {
        $("#filter-name").text(sSearchNew);
        $("#filter-name").append('<a> <img onclick="clearLink()" src="../css/icon/cancelar.svg" style="margin-left:15px" width="15px"></a>')
        $.ajax({
            url: 'php/search.php',
            method: "post",
            data: { nameUser: sSearchNew, boolTeacher: boolTeacher },
            success: function (datos) {
                datos = JSON.parse(datos);
                for (i = 0; i < datos.length; i++) {
                    if (datos[i].user != user) {
                        $('#list-Teacher').append(`<div class="row student-data"> 
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2"><p class="text-center"><a href="#" onclick="profileUser('`+ datos[i].user + `',`+teacher+`)"  id="profile` + datos[i].id + `"><img src="../css/icon/ver.svg" width="35px"></a></p></div>
                        <div class="col-sm-3"><p class="text-center p" id="teacher-name">`+ datos[i].user + ` <img src="../css/icon/`+datos[i].language+`.svg" width="16px"></p></div>
                        <div class="col-sm-3"><p class="text-center p">`+ sala + `</p></div>
                        <div class="col-sm-2"><button class="change-sala" onclick="ChangeChat('`+ datos[i].sala + `')" id="` + datos[i].id + `"><img src="../css/icon/bocadillo.svg" width="35px"></button></div>
                        </div>`)
                    }

                }
            }
        });
    }
    else {
        $("#filter-name").text("No hay ninguna busqueda actualmente");
        ShowUser(boolTeacher);
    }
}
function clearLink() {
    $("#search").val("");
    $("#filter-name").text("No hay ninguna busqueda actualmente");
    ShowUser(boolTeacher);
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
                    '<div class="col-sm-2"> </div><div class="col-sm-6"><p id="name-student">'+datos[i].user+'</p></div>'+
                        `<div class="col-sm-4"><a href="#"><img src="/css/icon/borrar.svg" width="16px" onclick="DeleteStudent('`+datos[i].user+`')"/> </a></div>`)
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
