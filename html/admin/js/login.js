$(document).ready(function () {
    $("#login").click(function () {
        username = $('#username').val();
        password = $('#password').val();
        $.ajax({
            url: 'http://localhost:8080/fanlist/controller/controller.php?username=' + username + '&password=' + password,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                $("#respuesta").append(data.result);
                $("#respuesta").append("dasfasdf");
            },
            error: function () {
                $('#error').html('<p>No se ha podido cargar la página</p>');
            }
        });
    });
});

