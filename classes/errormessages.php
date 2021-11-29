<?php

class ErrorMessages{
    //ERROR|SUCCESS
    //Controller
    //method
    //operation
    
    //const ERROR_ADMIN_NEWCATEGORY_EXISTS = "El nombre de la categoría ya existe, intenta otra";
    const PRUEBA = "1f8f0ae8963b16403c3ec9ebb851f156";
    const ERROR_REGISTRO_ERROR = "112f01896F24F2eFbb851f252";
    const ERROR_REGISTRO_EDAD = "aud8sun37hunsundshun3h78anbu";
    const ERROR_REGISTRO_VACIO = "f2f018g2a2eFdddd51aaaa2";
    const ERROR_REGISTRO_EXISTE = "7a778f7f5a78h55auyhy7g789a";
    const ERROR_LOGIN_AUTHEN_VACIO = "8a8jnfunv6sajnad7tg54na893";
    const ERROR_LOGIN_AUTHEN_INCORRECT = "7hcudy3ubansimdfuy37q";
    const ERROR_LOGIN_AUTHEN_ERROR = "mnaf89jsnmsh7ana773iaja";
    const ERROR_USER_UPDATEPHOTO = "77sdh7ghh30pk9dfj83jaui";
    const ERROR_USER_UPDATEPHOTO_FORMAT = "8u3nd7sh7du23890qd8h7e3";
    const ERROR_CONTRACT_DELETE = "87ifjf7jdys726wsd5th4u8ej";

    
    const ERROR_ADMIN_BACKUP = "uausdushdnsna87h76gbab6bs";
    const ERROR_ADMIN_RESTORE = "7ajisd7y8shdnsadh7as8dhjs";
    

    private $errorsList = [];

    public function __construct()
    {
        $this->errorsList = [
            ErrorMessages::PRUEBA => 'El nombre de la categoría ya existe, intenta otra',
            ErrorMessages::ERROR_REGISTRO_ERROR => 'Error inesperado',
            ErrorMessages::ERROR_REGISTRO_EDAD => 'Error, edad menor de 18 años',
            ErrorMessages::ERROR_REGISTRO_VACIO =>'Llenar campos vacíos',
            ErrorMessages::ERROR_REGISTRO_EXISTE =>'El WhatsApp del usuario ya existe',
            ErrorMessages::ERROR_LOGIN_AUTHEN_VACIO =>'Llenar campos vacíos',
            ErrorMessages::ERROR_LOGIN_AUTHEN_INCORRECT =>'Datos incorrectos',
            ErrorMessages::ERROR_LOGIN_AUTHEN_ERROR =>'Error, ingresar datos',

            ErrorMessages::ERROR_USER_UPDATEPHOTO          => 'Hubo un error al actualizar la foto',
            ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT   => 'El archivo no es una imagen',

            ErrorMessages::ERROR_CONTRACT_DELETE => 'Hubo un error al eliminar',

            
            ErrorMessages::ERROR_ADMIN_BACKUP => 'Ocurrio un error inesperado al crear la copia de seguridad',            
            ErrorMessages::ERROR_ADMIN_RESTORE => 'Ocurrio un error inesperado al realizar la restauración'
            

        ];
    }

    function get($hash){
        return $this->errorsList[$hash];
    }

    function existsKey($key){
        if(array_key_exists($key, $this->errorsList)){
            return true;
        }else{
            return false;
        }
    }

}
?>