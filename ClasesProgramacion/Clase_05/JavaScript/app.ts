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

    export function EjecutarTraerPorEstado():void {
        let parametros:string = `queHago=TraerTodos_PorEstado`;

        ajax.Post("administracion.php", 
                    Success, 
                    parametros, 
                    Fail);            
    } 
    
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