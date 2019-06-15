var choose;
$(function(){
    choose = "registro";
    $("#sing-in").click(function(){
        Entrar();
        choose = "entrar";
    });
    $("#sing-up").click(function(){
        Registro();
        choose = "registro";
    })
    // $("#ok").click(function(){
    //     //console.log("a")
       
    //     //Sino mensaje de que rellene todos los datos
        
    // });
})

function ClickOk(){
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
        <strong>Error!</strong>Algún campo puede estar vacios o ser incorrectos.
      </div>`)
    }
}
function Registro(){
    $("#frm-show").html(` <div id="input-error"></div>

    <p>Usuario</p><input type="text" name="user" id="user">
    <p>Contraseña</p><input type="password" name="pass" id="pass">
    <p>Repetir contraseña</p><input type="password" name="repeatpass" id="repeatpass">
    <p>Email</p><input type="email" name="email" id="email">
    <p>Fecha de nacimiento</p><input type="Date" name="born" id="born">
    <p>Lenguaje</p> <select name="language" id="languaje">
            <option value="Spain">Español</option>
            <option value="English">Inglés</option>
        </select>
    <p>Code</p><input type="text" name="code" id="code">
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="ok" onclick="ClickOk()">Entrar</button>
    </div>`)
    $('#sing-up').css("border","1px solid var(--primary-color)")
    $('#sing-in').css("border","none")
   

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
    $('#sing-in').css("border","1px solid var(--primary-color)")
    $('#sing-in').css("border-radius","15px")
    $('#sing-up').css("border","none")

}
//Comprobar que no sean espacios en blanco unicamente
function Comprueba(){
    $("#input-error").html("")
    hoy = new Date();
    hoy.setHours(0,0,0,0);
    var inputs = document.getElementsByTagName('input');
    value = true;
    for(let i = 0; i<inputs.length;i++){
        value = inputs[i].value.replace(/ /g, "") != "";
        if(inputs[i].name == 'born'){
            dateform = new Date(inputs[i].value)
            if(dateform>hoy){
                return false;
            }
        }
        if(inputs[i].name == 'email'){
            if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(inputs[i].value)){
                return false;
            }
        }
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
        data: { usuario: $('[name="user"]').val().replace(/ /g, ""), pass:$('[name="pass"]').val(), email:$('[name="email"]').val(), code:$('[name="code"]').val(), 
        born:$('[name="born"]').val(), lang:$('[name="language"]').val() },
        success: function (datos) {
            //console.log(datos)
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
                if(datos == "NoCode"){
                    $("#input-error").html("")
                    $("#input-error").html(`<div class="alert alert-danger">
                    <strong>Código no correcto.</strong> Por favor utilice un código valido </div>`)
                }
                else{
                    if(datos == "UserError"){
                        $("#input-error").html("")
                        $("#input-error").html(`<div class="alert alert-danger">
                        <strong>Usuario ya registrado.</strong>Por favor pruebe con otro nombre </div>`)
                    }
                    else{
                        $("#frm-show").html("Actualmente hay un error en el sistema, pruebe a recargar la página. Si el problema continua contacte con el administrador de la web");
                    }
                }
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


