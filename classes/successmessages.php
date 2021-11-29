<?php

class SuccessMessages{
    //ERROR|SUCCESS
    //Controller
    //method
    //operation
    const SUCCESS_ADMIN_NEWCATEGORY  = "f52228665c4f14c8695b194f670b0ef1";
    
    const SUCCESS_ADMIN_BACKUP  = "a7sdhsnds7hdandnbadmsdnuhndhu7sd";
    const SUCCESS_ADMIN_RESTORE  = "audshd7shdnasdyg6ygad6ts8s6dsg";

    const SUCCESS_REGISTRO_SUCCESS   = "9a878dfbuyy678ai9898ytabufy60ef1";    
    const SUCCESS_CONTRATO_SUCCESS   = "ajaisniisndisiakmmubnanjsnujnad1";
    const SUCCESS_USER_UPDATEPHOTO   = "99oijdfiodnihaninuciksiapopuna66";

    const SUCCESS_DELETE             = "7hj7a7sdh77jjd7aunio0989w88vyn8f";    
    const SUCCESS_UPDATE             = "9d09o9dikninasiomijhdjasjduhssjn";
    
    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY => "Nueva categoría creada correctamente",

            SuccessMessages::SUCCESS_ADMIN_BACKUP => "Copia de seguridad realizada con éxito",
            SuccessMessages::SUCCESS_ADMIN_RESTORE => "Se restauró correctamente la copia de seguridad",

            SuccessMessages::SUCCESS_REGISTRO_SUCCESS => "Registro Exitoso",
            SuccessMessages::SUCCESS_CONTRATO_SUCCESS => "Registro Exitoso",
            SuccessMessages::SUCCESS_USER_UPDATEPHOTO => "Imagen de anfitrion actualizada correctamente",

            SuccessMessages::SUCCESS_DELETE => "Eliminación Exitoso",            
            SuccessMessages::SUCCESS_UPDATE => "Actualización Exitoso"
        ];
    }

    function get($hash){
        return $this->successList[$hash];
    }

    function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }else{
            return false;
        }
    }
}
?>