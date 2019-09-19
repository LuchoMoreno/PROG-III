"use strict";
/// <reference path="ajax.ts" />
var Main;
(function (Main) {
    var ajax = new Ajax();
    ////////////////////////////////////////////////////// OBTENCION DE DATOS
    function EjecutarObtenerID(nombrePlaceHolder) {
        var idObtenida = document.getElementById(nombrePlaceHolder).value;
        return idObtenida;
    }
    Main.EjecutarObtenerID = EjecutarObtenerID;
    ////////////////////////////////////////////////////// FUNCION PARA TRAER TODOS LOS USUARIOS.
    function EjecutarTraerTodos() {
        var parametros = "queHago=TraerTodos_Usuarios";
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarTraerTodos = EjecutarTraerTodos;
    ////////////////////////////////////////////////////// FUNCION PARA TRAER UN USUARIO CON UNA ID ESPECIFICA.
    function EjecutarTraerPorID() {
        var idObtenida = EjecutarObtenerID("txtID");
        var parametros = "queHago=TraerTodos_PorID&id=" + idObtenida;
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarTraerPorID = EjecutarTraerPorID;
    ////////////////////////////////////////////////////// FUNCION PARA TRAER LOS USUARIOS QUE TENGAN UN ESTADO ESPECIFICO.
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
    //////////////////////////////////////////////////////  FUNCIONES DE REDIRECCCION.
    function RedireccionarNuevoUsuario() {
        window.location.href = 'nuevoUsuario.html';
    }
    Main.RedireccionarNuevoUsuario = RedireccionarNuevoUsuario;
    function RedireccionarModificarUsuario() {
        window.location.href = 'modificarUsuario.html';
    }
    Main.RedireccionarModificarUsuario = RedireccionarModificarUsuario;
    //////////////////////////////////////////////////////
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
    function ObtenerTodosLosDatosParaModificar() {
        var idUsuarioAModificarObtenida = document.getElementById("dataIDUsuarioModificado").value;
        var nombreObtenidoModificado = document.getElementById("dataNuevoNombre").value;
        var apellidoObtenidoModificado = document.getElementById("dataNuevoApellido").value;
        var claveObtenidaModificada = document.getElementById("dataNuevaClave").value;
        //var datosCompletosModificados : string = "UPDATE `usuarios` SET (`nombre`, `apellido`, `clave`, `perfil`, `estado`) VALUES " + "("+"'"+nombreObtenidoModificado+"'" + "," + "'"+apellidoObtenidoModificado +"'"+ "," +"'"+claveObtenidaModificada+"'" + "," + "1,1)" + " WHERE `id` = " + idUsuarioAModificarObtenida;
        //UPDATE `usuarios` SET `id`=[value-1],`nombre`=[value-2],`apellido`=[value-3],`clave`=[value-4],`perfil`=[value-5],`estado`=[value-6] WHERE 1
        var datosCompletosModificados = "UPDATE `usuarios` SET `nombre`=" + "'" + nombreObtenidoModificado + "'" + ", `apellido`=" + "'" + apellidoObtenidoModificado + "'" + ", `clave`=" + "'" + claveObtenidaModificada + "'" + " WHERE `id` = " + idUsuarioAModificarObtenida;
        return datosCompletosModificados;
    }
    Main.ObtenerTodosLosDatosParaModificar = ObtenerTodosLosDatosParaModificar;
    function EjecutarCargarUsuarioModificado() {
        var usuarioModificado = ObtenerTodosLosDatosParaModificar();
        var parametros = "queHago=ModificarUsuario&cargarModificacion=" + usuarioModificado;
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarCargarUsuarioModificado = EjecutarCargarUsuarioModificado;
    //////////////////////////////////////////////////////
    function EjecutarEliminarUsuario() {
        var idObtenidaAEliminar = EjecutarObtenerID("txtIDEliminar");
        var parametros = "queHago=EliminarUsuario&idEliminar=" + idObtenidaAEliminar;
        ajax.Post("administracion.php", Success, parametros, Fail);
    }
    Main.EjecutarEliminarUsuario = EjecutarEliminarUsuario;
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