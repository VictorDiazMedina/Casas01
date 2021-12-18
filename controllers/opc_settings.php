<?php

require_once 'models/usermodel.php';
class Opc_settings extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("OPC_SETTINGS:: construct() " . $this->user->getUserWhats());
        
    }

    //Muestra la Vista con datos del Usuario logeado
    function render(){
        error_log("OPC_SETTINGS:: render()");

        $this->view->render('anfitrion/opc_settings', [
            'user'                => $this->user

        ]);
    }
    
    //Actualiza infromacion del usuario Anfitrion
    function updateUser(){
        if($this->existPOST(['userNomb', 'userAp', 'userAm', 'userFechNac'])){
            
            $userNomb = $this->getPost('userNomb');
            $userAp   = $this->getPost('userAp');
            $userAm   = $this->getPost('userAm');
            $userFechNac   = $this->getPost('userFechNac');
            error_log("OPC_SETTINGS:: updateUser() " . $userFechNac);
            //validate data
            if($userNomb == '' || empty($userNomb) || $userAp == '' || empty($userAp) || $userAm == '' || empty($userAm) || $userFechNac == '' || empty($userFechNac)){
                // error al validar datos
                
                $this->redirect('opc_settings', ['error'=> ErrorMessages::ERROR_REGISTRO_VACIO]);
                return;
            }

            if($this->calculaedad ($userFechNac) < 18){
                $this->redirect('opc_settings',['error'=> ErrorMessages::ERROR_REGISTRO_EDAD]);
            }else{
                $this->user->setUserNomb($userNomb);
                $this->user->setUserAp($userAp);
                $this->user->setUserAm($userAm);
                $this->user->setUserFechNac($userFechNac);
    
                if($this->user->update()){
                    
                    $this->redirect('opc_settings',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                }else{
                    $this->redirect('opc_settings',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                }
            }
            
        
            
        }else{
            $this->redirect('opc_settings',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
        }
    }


    //Devuelve la edad dando una fecha de nacimiento
    function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
        return $ano_diferencia;
    }
      
    //Actualiza fotografia del usuario anfitrion
    function updateImg(){
        if(!isset($_FILES['photo'])){
            $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            return;
        }
        $photo = $_FILES['photo'];
        
        $target_dir = "assets/image/anfitriones/";
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //Es una imagen
            $uploadOk = 1;
        } else {
            //No es imagen
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            
            $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT]);
     
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $this->user->updatePhoto($hash, $this->user->getId());
                unlink("assets/image/anfitriones/" . $this->user->getUserPerfil());
                $this->redirect('opc_settings', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPHOTO]);
            } else {
                $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            }
        }
        
    
    }


}
?>