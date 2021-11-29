<?php

require_once 'models/usermodel.php';
class Opc_settings extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Anfitrion::constructor() " . $this->user->getUserWhats());
        
    }


     function render(){
        error_log("Anfitrion::RENDER() ");

        $this->view->render('anfitrion/opc_settings', [
            'user'                => $this->user

        ]);
    }
    
    
    function updateUser(){
        if($this->existPOST(['userNomb', 'userAp', 'userAm', 'userFechNac'])){
            
            $userNomb = $this->getPost('userNomb');
            $userAp   = $this->getPost('userAp');
            $userAm   = $this->getPost('userAm');
            $userFechNac   = $this->getPost('userFechNac');
            error_log("Anfitrion::updateUser() " . $userFechNac);
            //validate data
            if($userNomb == '' || empty($userNomb) || $userAp == '' || empty($userAp) || $userAm == '' || empty($userAm) || $userFechNac == '' || empty($userFechNac)){
                // error al validar datos
                //$this->errorAtSignup('Campos vacios');
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
                    //$this->view->render('login/index');
                    $this->redirect('opc_settings',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                }else{
                    /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                    return; */
                    $this->redirect('opc_settings',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                }
            }
            
        
            
        }else{
            // error, cargar vista con errores
            //$this->errorAtSignup('Ingresa nombre de usuario y userAp');
            $this->redirect('opc_settings',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
        }
    }


    function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
        return $ano_diferencia;
      }
      
    
    function updateImg(){
        if(!isset($_FILES['photo'])){
            $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            return;
        }
        $photo = $_FILES['photo'];
        error_log("PPPPPPPPPPPPPPPPPPPPPPPPPPPPPP" .  $photo);
        $target_dir = "assets/image/anfitriones/";
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        error_log("Anfitrion::updateImg(): " .  $filename);
        error_log("Anfitrion::updateImg(): " .  $hash);
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT]);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $this->user->updatePhoto($hash, $this->user->getId());
                unlink("assets/image/anfitriones/" . $this->user->getUserPerfil());
                $this->redirect('opc_settings', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPHOTO]);
            } else {
                $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            }
        }
        
    
        /*$photo =  $_FILES['photo'];
        
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];

        $directorio = "assets/image/anfitriones/";
        $archivo = $directorio . basename($_FILES["photo"]["name"]);
        error_log("Anfitrion::updateImg(): " .  $filename);
        
        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        //VALIDA QUE ES UNA IAMGEN
        $CheckImgSize = getimagesize($_FILES["photo"]["tmp_name"]);
        
        if($CheckImgSize != false){
            //VALIDA EL TAMAÑO
            $size = $_FILES["photo"]["size"];
            if($size > 500000){
                //ERROR, IMAGEN DEBE SER MENOR A 500KB
            }else{
                //VALIDA EL TIPO
                if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                   
                    if(move_uploaded_file($_FILES["photo"]["tmp_name"], $archivo)){
                        //SUCCES, IMAGEN ACTUALIZADA
                    }else{
                        //ERROR, AL SUBIR IMAGEN
                    }
                }else{
                    //ERROR, SOLO SE ACEPTA JPG/JPEG
                }
            }
        }else{
            //ERROR, NO ES IMAGEN
        }*/
    }


}
?>