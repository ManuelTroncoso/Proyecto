$(function(){
    let choose = "registro";
    $("#sing-in").click(function(){
        Entrar();
        choose = "entrar";
    });
    $("#sing-up").click(function(){
        Registro();
        choose = "registro";
    })
    $("#ok").click(function(){
        //console.log("a")
        if(Comprueba()){
            if(choose == "entrar"){
                ConexionAjax();
            }else{
                if(password()){
                    RegistroAjax();
                }else{
                    $("#input-error").html(`<div class="alert alert-danger">
                        <strong>Error!</strong> Las contraseñas no coinciden
                    </div>`)
                }                
            }
        }
        else{
            $("#input-error").html(`<div class="alert alert-danger">
            <strong>Error!</strong> Por favor, rellene todos los campos
          </div>`)
        }
        //Sino mensaje de que rellene todos los datos
        
    });
})

function Registro(){
    $("#frm-show").html(`<div id="input-error"></div><p>Usuario</p><input type="text" name="user" id="" value="">
    <p>Contraseña</p><input type="password" name="pass" id=""> 
    <p>Repetir contraseña</p><input type="password" name="repeatpass" id="">
    <p>Email</p><input type="email" name="email" id="">
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary" id="ok">Entrar</button>
    </div>`)
    $('#sing-up').css("background-color","silver")
    $('#sing-in').css("background-color","white")

}
function Entrar(){
    $("#frm-show").html(`<form action="php/db.php">
    <div id="input-error"></div>
    <p>Usuario</p><input type="text" name="user" id="">
    <p>Contraseña</p><input type="password" name="pass" id=""><br>
    <label><input type="checkbox" name="student" id=""><span>Eres un alumno, indicanoslo aquí!</span></label>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary" id="ok">Entrar</button>
    </div></form>`)
    $('#sing-in').css("background-color","silver")
    $('#sing-up').css("background-color","white")

}
//Comprobar que no sean espacios en blanco unicamente
function Comprueba(){
    $("#input-error").html("")
    var inputs = document.getElementsByTagName('input');
    value = true;
    for(let i = 0; i<inputs.length;i++){
        value = inputs[i].value != ""
        if(!value){
            return false;
        }
    };
    return true;
}
function password(){
    if( $('[name="repeatpass"]').val() == $('[name="pass"]').val()){
        return true;
    }
}

function RegistroAjax(){
    $.ajax({
        url: '/php/logincdb.php',
        method: "post",
        data: { usuario: $('[name="user"]').val(), pass:$('[name="pass"]').val(), email:$('[name="email"]').val() },
        success: function (datos) {
            if(datos == "true"){
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
            else{
                $("#frm-show").html("Actualmente hay un error en el sistema porfavor intentelo de nuevo mas tarde");
            }
        }
    });
}
// function ConexionAjax(){
//     $.ajax({
//         url: '/php/db.php',
//         method: "post",
//         data: { usuario: $('[name="user"]').val(), pass:$('[name="pass"]').val(), student: $('[name="student"]').prop('checked') },
//         success: function (datos) {
//             console.log(datos)
//             if(datos == "true"){
//                 if($('[name="student"]').prop('checked')){
//                     window.location.href = "student/menu.php";
//                 }
//                 else{
//                     window.location.href = "teacher/menu.html";
//                 }
//             }
//             else{
//                 $("#input-error").html(`<div class="alert alert-danger">
//                 <strong>Error!</strong> El nombre de usuario o contraseña no son correctos
//               </div>`)
//             }
//         }
//     });
// }


