$(function () {
    if(user[0].tuit == null){
        aTuit = new Array();
    }
    else{
        aTuit = JSON.parse(user[0].tuit);
    }
    CreateListTuit();
    
});

//Añade el json y lo sube a la base de datos, evitar que no este vacio.
function AddTuit() {
    sTuit = "";
    var f = new Date();
    let date = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
    tuit = JSON.parse('{"id":"' + aTuit.length + '","name":"' + user[0].user + '","tuit":"' + $('#id-tuit').val() + '","date":"' + date + '"}');
    aTuit.push(tuit);
    sTuit = JSON.stringify(aTuit);
    console.log(aTuit);
    $.ajax({
        url: '../php/addTuit.php',
        method: "post",
        data: { tuit: sTuit, nameUser: user[0].user },
        success: function (datos) {
            //console.log(datos)
            if (datos == "Ready") {
                alert("Tuit añadido")
            }
        }
    });
    $.ajax({
        url: '../php/allTeacher.php',
        method: "post",
        data: { nameUser: user[0].user },
        success: function (datos) {

        }
    });
    $('#id-tuit').val("");
    CreateListTuit();
    ChangeDateShow('tuit')
}

function CreateListTuit(){
    $("#list-tuit").html("");
   console.log(aTuit)
    if(aTuit.length != 0){
        for(i = 0;i<aTuit.length;i++ ){
            //console.log(aTuit[i])
            $("#list-tuit").append(
            "<div class='row'>"+
                "<div class='col-sm-2'></div>"+
                "<div class='col-sm-8 box-tuit' id='"+aTuit[i].id+"'> "+
                    "<p class='name'>"+aTuit[i].name+"</p>"+
                    "<p class='tuit'>"+aTuit[i].tuit+"</p>"+
                    "<div><button class='retuit btn btn-link' width='16px' onclick='Retuit("+aTuit[i].id+")'>Retuitear</button>  <span class='date'>"+aTuit[i].date+"</span></div> "+
                "</div>"+
                "<div class='col-sm-2'></div>"+
            "</div>");
        }
        if(user[0].user != userProfile){
            $("#add-Tuit").css("display", "none");
            $("#nameUser").text("Perfil de " + user[0].user);
            
        }
        else{
            $(".retuit").each(function(index){
                $(this).css("display", "none");
            });
        }
    }else{
        HasDate("#list-tuit");
    }
    
}
function CreateListRetuit(){
    $("#list-tuit").html("");
    aRetuit = JSON.parse(user[0].Retuit);
    console.log(aRetuit)
    if(aRetuit != null){
        for(i = 0;i<aRetuit.length;i++ ){
            $("#list-tuit").append(
            "<div class='row'>"+
                "<div class='col-sm-2'></div>"+
                "<div class='col-sm-8 box-tuit' id='"+aRetuit[i].id+"'> "+
                    "<p class='name'>"+aRetuit[i].name+"</p>"+
                    "<p class='tuit'>"+aRetuit[i].tuit+"</p>"+
                    "<div><span class='date'>"+aRetuit[i].date+"</span></div> "+
                "</div>"+
                "<div class='col-sm-2'></div>"+
            "</div>");
        }
        if(user[0].user != userProfile){
            $("#add-Tuit").css("display", "none");
            $("#nameUser").text("Perfil de " + user[0].user);

        }
    }
    else{
        HasDate("#list-tuit");
    }
}
function Retuit(x){
    //console.log( JSON.stringify(aTuit[x]));
    $.ajax({
        url: '../php/addTuit.php',
        method: "post",
        data: { retuit: JSON.stringify(aTuit[x]), nameUser: userProfile },
        success: function (datos) {
            console.log(datos)
            if (datos == "Ready") {
                alert("Retuit realizado")
            }
        }
    });
}

function ChangeDateShow(x){
    console.log(x);
    if(!($("#"+x).hasClass("active"))&& x=='retuit'){
        $("#"+x).addClass("btn-link active").removeClass("btn-primary")
        $("#tuit").removeClass("btn-link active").addClass("btn-primary");
        CreateListRetuit();
    }
    else{
        if(!($("#"+x).hasClass("active")) && x=='tuit'){
            $("#"+x).addClass("btn-link active").removeClass("btn-primary")
            $("#retuit").removeClass("btn-link active").addClass("btn-primary");
            CreateListTuit();
        }
    }
}
function HasDate(x){
    console.log(x);
    if($(x).html() == ""){
        $(x).append(`<div class="row"><img src="../../css/icon/void.svg" width="170px" id="void" alt=""></div>
        <h3 class="text-center">No hay elementos para mostrar</h3>
        <h3 class="text-center">Pruebe mas tarde</h3>`)
    }
}