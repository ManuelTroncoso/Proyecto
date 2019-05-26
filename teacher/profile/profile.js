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
            console.log(datos)
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
    CreateListTuit();
}

function CreateListTuit(){
    $("#list-tuit").html("");
    for(i = 0;i<aTuit.length;i++ ){
        $("#list-tuit").append("<div style='border-bottom:1px solid black' id='"+aTuit[i].id+"'><p>"+aTuit[i].name+"</p><p>"+aTuit[i].tuit+"</p><p>"+aTuit[i].date+"</p></div>");
    }
}