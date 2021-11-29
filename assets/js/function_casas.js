
var tableCasas;

document.addEventListener('DOMContentLoaded', function(){

	tableCasas = $('#tableCasas').DataTable({ /*ID de la tabla*/
		"aProcessing":true,
		"aServerside":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" /*Idioma de visualizacion*/
		},
		"ajax":{
			"url": " "+base_url+"/cassas/getCasas",/* Ruta a la funcion getCasas que esta en el controlador Casas.php*/
		"dataSrc":""
		},
		"columns":[/* Campos de la base de datos*/
			{"data":"idCasa"},
			{"data":"casa_Nombre"},
			{"data":"casa_Direccion"},
			{"data":"idUsuario"},
			{"data":"options"}
		],
		"responsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10, /*Mostrará los primero 10 registros*/
		"order":[[0,"desc"]] /*Ordenar de forma Desendente*/

	});

	/*var formCasa = document.querySelector("#formCasa");
	formCasa.onsubmit = function(e){
		e.preventDefault();

		let strCasa = document.querySelector("#txtNombreCasa").value;
		let strDireccion = document.querySelector("#txtDireccion").value;

		if(strCasa == "" || strDireccion == ""){//verifica que los campos no  esten vacios
			swal("Por favor", "Escribe nombre de la casa y dirección", "error"); //Si lo estan, enviara un msj de error
			return false;
		}else{
			
			
		}
	}*/
});



document.addEventListener('DOMContentLoaded', function(){

    if(document.querySelector("#formCasa")){
        let formCasa = document.querySelector("#formCasa");
        formCasa.onsubmit = function(e){
            e.preventDefault();

            let strCasa = document.querySelector("#txtNombreCasa").value;
		    let strDireccion = document.querySelector("#txtDireccion").value;

		if(strCasa == "" || strDireccion == ""){//verifica que los campos no  esten vacios
			swal("Por favor", "Escribe nombre de la casa y dirección", "error"); //Si lo estan, enviara un msj de error
			return false;
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject;
                var ajaxUrl = 'http://localhost/Casas//Cassas/getCasas';//Funcion donde llamamos desde el controlador, dandole la ruta
                var formData = new FormData(formCasa); //Objeto del formulario
                request.open("POST",ajaxUrl,true); 
                request.send(formData);

                console.log(request);
            }
        }
    }
}, false);


$('#tableCasas').DataTable();

function openModal(){
    $('#ModalFormCasa').modal('show');
}