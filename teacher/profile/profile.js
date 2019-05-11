//console.log(user[0]);
var aTuit = new Array();
$(function(){
    //Elimina el último caracter del json para poder crear un Json de nuevo
    aTuit.push(user[0].tuit);
    aTuit[0] = aTuit[0].slice(0, -1);
    console.log(aTuit)
});

//Añade el json y lo sube a la base de datos, evitar que no este vacio.
function AddTuit(){
    tuit = ',{"tuit":"'+ $('#id-tuit').val()+'"}]'
    aTuit.push(tuit);
    sTuit = "";
    for(i=0; i < aTuit.length;i++){
        sTuit = sTuit + aTuit[i];
    }
    //console.log(sTuit);
    $.ajax({
        url: '../php/addTuit.php',
        method: "post",
        data: { tuit : sTuit, nameUser : user[0].user },
        success: function (datos) {
            console.log(datos)
            if(datos == "Ready"){
                alert("Tuit añadido")
            }
        }
    });
    $.ajax({
        url: '../php/allTeacher.php',
        method: "post",
        data: { nameUser : user[0].user },
        success: function (datos) {
           
        }
    });
}
