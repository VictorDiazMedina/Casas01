<?php

require_once 'models/usermodel.php';
require_once 'models/housemodel.php';

class Register extends SessionController{

    //Constructor
    function __construct(){
        parent::__construct();
    }


    //Carga Render de la vista
    function render(){
        $this->view->render('login/register');
    }

    //Funcion de registro de un nuevo usuario
    function nuevoUsuario(){
        if($this->existPOST(['userWhats', 'userPass'])){
            
            $userWhats = $this->getPost('userWhats');
            $userPass = $this->getPost('userPass');
            
            //Verifica que los datos no esten vacios, si se encuentran vacíos
            //recarga la página mostrando un mensaje de Error
            if($userWhats == '' || empty($userWhats) || $userPass == '' || empty($userPass)){
                // error al validar datos
                $this->redirect('register', ['error'=> ErrorMessages::ERROR_REGISTRO_VACIO]);
            }else{
            //De lo contrario llama al Modelo Usuario
            //Inserta los datos
            $user = new UserModel();
            $user->setUserWhats($userWhats);
            $user->setUserPassword($userPass);
            $user->setRole("user");
            $user->setUserStatus("0"); //1 ACEPTADO - 0 PROCESO
            
            //Verifica que no exista el Usuario
            if($user->exists($userWhats)){
                //'Error al registrar el usuario. Elige un nombre de usuario diferente'
                $this->redirect('register',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
            //Si no existe finalmente guarda el usuario en la base de datos.
            }else if($user->save()){
                $userCa = new UserModel();
                $house  = new HouseModel();
                $idUser = $userCa->idWhats($userWhats);
                $house->newHouse($idUser);
                
                $houseCarp  = new HouseModel();
                $micarpeta = './assets/image/anfitriones/'.$houseCarp->getIdHouse($idUser).'';
                if (!file_exists($micarpeta)) {
                    mkdir($micarpeta, 0777, true);
                }
                $this->redirect('login',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
            }else{
                $this->redirect('register',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
            }
            }

            
        }else{
            // error, cargar vista con errores
            $this->redirect('register',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
        }
    }
}

?>