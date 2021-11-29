$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});


document.addEventListener('DOMContentLoaded', function(){

    if(document.querySelector("#formLogin")){
        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e){
            e.preventDefault();

            let strTelefono = document.querySelector("#txtTelefono").value;
            let strPassword = document.querySelector("#txtPassword").value;

            if(strTelefono == "" || strPassword == ""){//verifica que los campos no  esten vacios
                swal("Por favor", "Escribe teléfono y contraseña", "error"); //Si lo estan, enviara un msj de error
                return false;
            }else{
                swal("Bienvenido", "Inicio Exitoso", "success");
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject;
                var ajaxUrl = 'http://localhost/Casas//Login/loginUser';//Funcion donde llamamos desde el controlador, dandole la ruta
                var formData = new FormData(formLogin); //Objeto del formulario
                request.open("POST",ajaxUrl,true); 
                request.send(formData);

                if(request.readyState != 4) return;

                console.log(request);
            }
        }
    }


    if(document.querySelector("#formRes")){
        let formRes = document.querySelector("#formRes");
        formRes.onsubmit = function(e){
            e.preventDefault();

            
            
                swal("Registrado", "Registro Exitoso", "success");
                /*var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject;
                var ajaxUrl = 'http://localhost/Casas//Login/loginUser';//Funcion donde llamamos desde el controlador, dandole la ruta
                var formData = new FormData(formLogin); //Objeto del formulario
                request.open("POST",ajaxUrl,true); 
                request.send(formData);

                if(request.readyState != 4) return;

                console.log(request);*/
            
        }
    }
}, false);