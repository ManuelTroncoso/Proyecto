$(function () {
    ShowUser();
})
function ShowUser() {
    $.ajax({
        url: 'php/allStudent.php',
        method: "get",
        dataType: "json",
        success: function (datos) {
            console.log(datos)
            for (i = 0; i < datos.length; i++) {
                if (datos[i].user != $('#profile-student').text()){
                    $('#list-Student').append(`<div class="row student-data">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5"><p id="student-name">`+ datos[i].user + `</p></div>
                    <div class="col-sm-2"><p>`+ datos[i].language+`</p></div>
                    <div class="col-sm-2"><button id="`+ datos[i].id + `">Chatear!</button></div>
                    </div>`)
                }
                    
            }
        }
    });
}
