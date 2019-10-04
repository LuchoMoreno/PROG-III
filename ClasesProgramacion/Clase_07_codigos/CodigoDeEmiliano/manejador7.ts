function AjaxPOST():void {
    let xhttp : XMLHttpRequest = new XMLHttpRequest();
    //METODO; URL; ASINCRONICO?
    xhttp.open("POST", "./admin.php", true);
    let correo = (<HTMLTextAreaElement>document.getElementById("correo")).value;
    let clave = (<HTMLTextAreaElement>document.getElementById("clave")).value;
    //SETEO EL ENCABEZADO DE LA PETICION	
    xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    
    //ENVIO DE LA PETICION CON LOS PARAMETROS
    var usuario = 'usuario={"correo":"' + correo + '", "clave":"' + clave + '"}';
    xhttp.send(usuario);

    //FUNCION CALLBACK
    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta = JSON.parse(xhttp.responseText);
            if(respuesta.Existe){
                window.location.href = "./principal.php";
            } else{
                alert("No registrado");
            }
            console.log(respuesta.Usuario);
            console.log(respuesta.Existe);
            console.log(respuesta.Perfil);
        }
    };
}

function CrearUsuario():void{
    let xhttp : XMLHttpRequest = new XMLHttpRequest();
    //METODO; URL; ASINCRONICO?
    xhttp.open("POST", "./registroUsuario.php", true);
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    //INFO
    let nombre = (<HTMLTextAreaElement>document.getElementById("nombre")).value;
    let apellido = (<HTMLTextAreaElement>document.getElementById("apellido")).value;
    let perfil = (<HTMLTextAreaElement>document.getElementById("perfil")).value;
    let correo = (<HTMLTextAreaElement>document.getElementById("correo")).value;
    let clave = (<HTMLTextAreaElement>document.getElementById("clave")).value;
    var usuario = '{"nombre":"' + nombre + '", "apellido":"' + apellido + '", "perfil":' + perfil
    + ', "correo":"' + correo + '", "clave":"' + clave + '"}';
    //--------------FOTO----
    let foto : any = (<HTMLInputElement> document.getElementById("foto"));
    //INSTANCIO OBJETO FORMDATA
    let form : FormData = new FormData();
    //AGREGO PARAMETROS AL FORMDATA:
    //PARAMETRO RECUPERADO POR $_FILES
    form.append('foto', foto.files[0]);
    form.append('op', "subirFoto");
    form.append('usuario', usuario)
    //---------------FIN info FOTO----------------------
    //ENCABEZADO PARA FOTO
    
    xhttp.send(form);

    //FUNCION CALLBACK
    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);
            var respuesta = JSON.parse(xhttp.responseText);
            console.log(respuesta.Ok);
        }
    };
}