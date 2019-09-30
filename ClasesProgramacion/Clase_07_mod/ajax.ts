
class Main{
    public static Login()
    {
        let xmlh : XMLHttpRequest = new XMLHttpRequest();

        let correo = (<HTMLInputElement>document.getElementById("correo")).value;

        let clave = (<HTMLInputElement>document.getElementById("clave")).value;

        xmlh.onreadystatechange = () =>
        {
            if (xmlh.readyState == 4 && xmlh.status == 200)
            {
               var variable = JSON.parse(xmlh.responseText);
               console.log(variable);
            }
        };

        xmlh.open("POST","./test_usuario.php",true);

        xmlh.setRequestHeader("content-type","application/x-www-form-urlencoded");

        xmlh.send('usuario={"correo":"' + correo +'", "clave": "'+clave+'"}');

    }

    
    public static Crear()
    {
        let xmlh : XMLHttpRequest = new XMLHttpRequest();

        let correo = (<HTMLInputElement>document.getElementById("correo")).value;

        let clave = (<HTMLInputElement>document.getElementById("clave")).value;

        let nombre = (<HTMLInputElement>document.getElementById("nombre")).value;

        let apellido = (<HTMLInputElement>document.getElementById("apellido")).value;

        let perfil = (<HTMLInputElement>document.getElementById("perfil")).value;

        var estado = 1;

        let foto : any = (<HTMLInputElement> document.getElementById("foto"));

        let form : FormData = new FormData();

        form.append('foto', foto.files[0]);

        form.append('user','{"nombre":"' + nombre +'", "apellido":"' + apellido +'","perfil":'+ perfil +', "correo":"' + correo +'","estado":'+estado+' ,"clave": "'+clave+'"}');

        xmlh.open("POST","./adm_registro.php",true);

        xmlh.setRequestHeader("enctype", "multipart/form-data");

        //xmlh.send('user={"nombre":"' + nombre +'", "apellido":"' + apellido +'","perfil":'+ perfil +', "correo":"' + correo +'","estado":'+estado+' ,"clave": "'+clave+'"}');

        xmlh.send(form);



        xmlh.onreadystatechange = () =>
        {
            if (xmlh.readyState == 4 && xmlh.status == 200)
            {
               console.log(xmlh.responseText);
            }
        };


    }
}
