"use strict";
/// <reference path="ajax.ts" />
var Main;
(function (Main) {
    var ajax = new Ajax();
    function EjecutarTraerTodos() {
        var parametros = "queHago=TraerTodos_Usuarios";
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarTraerTodos = EjecutarTraerTodos;
    //////////////////////////////////////////////////////
    function EjecutarTraerPorID() {
        var idObtenida = EjecutarObtenerID();
        var parametros = "queHago=TraerTodos_PorID&id=" + idObtenida;
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarTraerPorID = EjecutarTraerPorID;
    function EjecutarObtenerID() {
        var idObtenida = document.getElementById("txtID").value;
        return idObtenida;
    }
    Main.EjecutarObtenerID = EjecutarObtenerID;
    //////////////////////////////////////////////////////
    function EjecutarTraerPorEstado() {
        var estadoObtenido = EjecutarObtenerEstado();
        var parametros = "queHago=TraerTodos_PorEstado&estado=" + estadoObtenido;
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarTraerPorEstado = EjecutarTraerPorEstado;
    function EjecutarObtenerEstado() {
        var estadoObtenido = document.getElementById("txtEstado").value;
        return estadoObtenido;
    }
    Main.EjecutarObtenerEstado = EjecutarObtenerEstado;
    //////////////////////////////////////////////////////
    function RedireccionarNuevoUsuario() {
        window.location.href = 'nuevoUsuario.html';
    }
    Main.RedireccionarNuevoUsuario = RedireccionarNuevoUsuario;
    function ObtenerTodosLosDatos() {
        var nombreObtenido = document.getElementById("dataNombre").value;
        var apellidoObtenido = document.getElementById("dataApellido").value;
        var claveObtenida = document.getElementById("dataClave").value;
        var datosCompletos = "INSERT INTO `usuarios`(`nombre`, `apellido`, `clave`, `perfil`, `estado`) VALUES " + "(" + "'" + nombreObtenido + "'" + "," + "'" + apellidoObtenido + "'" + "," + "'" + claveObtenida + "'" + "," + "1,1)";
        return datosCompletos;
    }
    Main.ObtenerTodosLosDatos = ObtenerTodosLosDatos;
    function EjecutarCargarUsuario() {
        var usuario = ObtenerTodosLosDatos();
        var parametros = "queHago=CargarNuevoUsuario&cargar=" + usuario;
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarCargarUsuario = EjecutarCargarUsuario;
    //////////////////////////////////////////////////////
    function Success(retorno) {
        console.clear();
        console.log(retorno);
        document.getElementById("divResulado").innerHTML = retorno;
    }
    function Fail(retorno) {
        console.clear();
        console.log(retorno);
        alert("Ha ocurrido un ERROR!!!");
    }
})(Main || (Main = {}));
//# sourceMappingURL=app.js.map