/// <reference path="ajax.ts" />

namespace Main{
    
    let ajax : Ajax = new Ajax();

    
    export function EjecutarTraerTodos():void {
        let parametros:string = `queHago=TraerTodos_Usuarios`;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    }    
     
    //////////////////////////////////////////////////////

    export function EjecutarTraerPorID():void {
        var idObtenida : string = EjecutarObtenerID();
        let parametros:string = `queHago=TraerTodos_PorID&id=` + idObtenida;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 

    export function EjecutarObtenerID():string {
        var idObtenida : string = (<HTMLInputElement> document.getElementById("txtID")).value;
        return idObtenida;        
    } 

    //////////////////////////////////////////////////////

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
    
    //////////////////////////////////////////////////////


    export function RedireccionarNuevoUsuario():void {
    window.location.href = 'nuevoUsuario.html';   
    }     


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