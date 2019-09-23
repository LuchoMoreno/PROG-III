/// <reference path="ajax.ts" />

namespace Main{
    
    let ajax : Ajax = new Ajax();

    
    ////////////////////////////////////////////////////// OBTENCION DE DATOS

    export function EjecutarObtenerID(nombrePlaceHolder : string):string {
        var idObtenida : string = (<HTMLInputElement> document.getElementById(nombrePlaceHolder)).value;
        return idObtenida;        
    } 


    ////////////////////////////////////////////////////// FUNCION PARA TRAER TODOS LOS USUARIOS.

    export function EjecutarTraerTodos():void {
        let parametros:string = `queHago=TraerTodos_Usuarios`;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    }    
     
    ////////////////////////////////////////////////////// FUNCION PARA TRAER UN USUARIO CON UNA ID ESPECIFICA.

    export function EjecutarTraerPorID():void {
        var idObtenida : string = EjecutarObtenerID("txtID");
        let parametros:string = `queHago=TraerTodos_PorID&id=` + idObtenida;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 

    ////////////////////////////////////////////////////// FUNCION PARA TRAER LOS USUARIOS QUE TENGAN UN ESTADO ESPECIFICO.

    export function EjecutarTraerPorEstado():void {
        var estadoObtenido : string = EjecutarObtenerEstado();
        let parametros:string = `queHago=TraerTodos_PorEstado&estado=` + estadoObtenido;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 

    export function EjecutarObtenerEstado():string {
        var estadoObtenido : string = (<HTMLInputElement> document.getElementById("txtEstado")).value;
        return estadoObtenido;        
    } 
    
    //////////////////////////////////////////////////////  FUNCIONES DE REDIRECCCION.


    export function RedireccionarNuevoUsuario():void {
    window.location.href = 'nuevoUsuario.html';   
    }     


    export function RedireccionarModificarUsuario():void {
        window.location.href = 'modificarUsuario.html';   
        }   


    //////////////////////////////////////////////////////


    export function ObtenerTodosLosDatos():string {
        var nombreObtenido : string = (<HTMLInputElement> document.getElementById("dataNombre")).value;
        var apellidoObtenido : string = (<HTMLInputElement> document.getElementById("dataApellido")).value;
        var claveObtenida : string = (<HTMLInputElement> document.getElementById("dataClave")).value;

        var datosCompletos : string = "INSERT INTO `usuarios`(`nombre`, `apellido`, `clave`, `perfil`, `estado`) VALUES " + "("+"'"+nombreObtenido+"'" + "," + "'"+apellidoObtenido +"'"+ "," +"'"+claveObtenida+"'" + "," + "1,1)";

        return datosCompletos; 
    } 


    export function EjecutarCargarUsuario():void {
        var usuario : string = ObtenerTodosLosDatos();
        let parametros:string = `queHago=CargarNuevoUsuario&cargar=` + usuario;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 


    //////////////////////////////////////////////////////

    export function ObtenerTodosLosDatosParaModificar():string {
        var idUsuarioAModificarObtenida : string = (<HTMLInputElement> document.getElementById("dataIDUsuarioModificado")).value;
        var nombreObtenidoModificado : string = (<HTMLInputElement> document.getElementById("dataNuevoNombre")).value;
        var apellidoObtenidoModificado : string = (<HTMLInputElement> document.getElementById("dataNuevoApellido")).value;
        var claveObtenidaModificada : string = (<HTMLInputElement> document.getElementById("dataNuevaClave")).value;
        
        //var datosCompletosModificados : string = "UPDATE `usuarios` SET (`nombre`, `apellido`, `clave`, `perfil`, `estado`) VALUES " + "("+"'"+nombreObtenidoModificado+"'" + "," + "'"+apellidoObtenidoModificado +"'"+ "," +"'"+claveObtenidaModificada+"'" + "," + "1,1)" + " WHERE `id` = " + idUsuarioAModificarObtenida;
        //UPDATE `usuarios` SET `id`=[value-1],`nombre`=[value-2],`apellido`=[value-3],`clave`=[value-4],`perfil`=[value-5],`estado`=[value-6] WHERE 1
        var datosCompletosModificados : string = "UPDATE `usuarios` SET `nombre`=" + "'" + nombreObtenidoModificado + "'" +", `apellido`=" + "'" + apellidoObtenidoModificado + "'" + ", `clave`=" + "'" +  claveObtenidaModificada + "'" + " WHERE `id` = " + idUsuarioAModificarObtenida;
        return datosCompletosModificados; 
    } 

    
    
    export function EjecutarCargarUsuarioModificado():void {
        var usuarioModificado : string = ObtenerTodosLosDatosParaModificar();
        let parametros:string = `queHago=ModificarUsuario&cargarModificacion=` + usuarioModificado;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 

    //////////////////////////////////////////////////////
    

    export function EjecutarEliminarUsuario():void {
        var idObtenidaAEliminar : string = EjecutarObtenerID("txtIDEliminar");
        let parametros:string = `queHago=EliminarUsuario&idEliminar=` + idObtenidaAEliminar;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 


    //////////////////////////////////////////////////////

    
    function Success(retorno:string):void {
        console.clear();
        console.log(retorno);
        (<HTMLDivElement>document.getElementById("divResulado")).innerHTML = retorno;
    }

    function Fail(retorno:string):void {
        console.clear();
        console.log(retorno);
        alert("Ha ocurrido un ERROR!!!");
    }
    
}