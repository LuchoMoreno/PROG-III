"use strict";
var Main = /** @class */ (function () {
    function Main() {
    }
    Main.Login = function () {
        var xmlh = new XMLHttpRequest();
        var correo = document.getElementById("correo").value;
        var clave = document.getElementById("clave").value;
        xmlh.onreadystatechange = function () {
            if (xmlh.readyState == 4 && xmlh.status == 200) {
                var variable = JSON.parse(xmlh.responseText);
                console.log(variable);
            }
        };
        xmlh.open("POST", "./test_usuario.php", true);
        xmlh.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xmlh.send('usuario={"correo":"' + correo + '", "clave": "' + clave + '"}');
    };
    Main.Crear = function () {
        var xmlh = new XMLHttpRequest();
        var correo = document.getElementById("correo").value;
        var clave = document.getElementById("clave").value;
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido").value;
        var perfil = document.getElementById("perfil").value;
        var estado = 1;
        var foto = document.getElementById("foto");
        var form = new FormData();
        form.append('foto', foto.files[0]);
        form.append('user', '{"nombre":"' + nombre + '", "apellido":"' + apellido + '","perfil":' + perfil + ', "correo":"' + correo + '","estado":' + estado + ' ,"clave": "' + clave + '"}');
        xmlh.open("POST", "./adm_registro.php", true);
        xmlh.setRequestHeader("enctype", "multipart/form-data");
        //xmlh.send('user={"nombre":"' + nombre +'", "apellido":"' + apellido +'","perfil":'+ perfil +', "correo":"' + correo +'","estado":'+estado+' ,"clave": "'+clave+'"}');
        xmlh.send(form);
        xmlh.onreadystatechange = function () {
            if (xmlh.readyState == 4 && xmlh.status == 200) {
                console.log(xmlh.responseText);
            }
        };
    };
    return Main;
}());
