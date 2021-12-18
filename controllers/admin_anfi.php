<?php

require_once 'models/housemodel.php';
require_once 'models/usermodel.php';

    class Admin_anfi extends SessionController{
        private $user;
        private $house;
        private $usesr;

        function __construct(){
            parent::__construct();
            error_log('ADMIN::construct-> ADMIN_ANFI');
        }

        //Mostrar Vista
        function render(){
            error_log('ADMIN::render -> Carga el Index de ADMIN');
            
            
                
                
            $this->house    = new HouseModel();
            $this->usesr     = new UserModel();

           
            $anfitriones = $this->usesr->getAnfi();
            
            $this->view->render('ADMIN/admin_anfi',[                   
                'anfitriones'           => $anfitriones
                ]);
            
        }

        //Obtener datos de Anfitrion y mandarlo en formato JSON
        function getHistoryJSON(){
            header('Content-Type: application/json');
            $res = [];
            $userModel     = new UserModel();
            $users = $userModel->getAnfi();
    
            foreach ($users as $user) {
                array_push($res, $user->toArray());
            }
            
            
            echo json_encode($res);
    
        }

        //Obtener datos de Usuario y mandarlo en formato JSON
        function getUser(){
        
            error_log("ADMIN_ANFI::getUser-> Inicio");
            
            if(!empty($_POST)){
                //extraer datos
                if($_POST['action'] == 'infoUser'){
                    
                    $id = $_POST['user'];
    
                    $res = [];
                    
                    $userModel     = new UserModel();
                    $user          = $userModel->getUser($id);
                    
                    
                    echo json_encode($user, JSON_UNESCAPED_UNICODE);
                    exit;
                }
                echo 'error';
            }
            exit;
        }

        //Actualizar el estatus de usuariio anfitrion por parte del Administrador
        function updateStatus(){
        
            error_log("ADMIN_ANFI::updateStatus-> Inicio");
            
            if(!empty($_POST)){
                if($_POST['action'] == 'updateStatus'){
                    
                    
                    $userStatus   = $_POST['options'];
                    $id           = $_POST['idUsuario'];
                        
                    $userModel     = new UserModel();


                    $userModel->setUserStatus($userStatus);
                    $userModel->setId($id);

                    if($userModel->updateStatus()){
      
                        echo json_encode('ok', JSON_UNESCAPED_UNICODE);
                        
                        exit;
                    }else{
                        
                    }
                            
                       
                   
                }
            }
            exit;
            
        }

        //Elimina al usuario anfitrion por parte del Administrador
        function deleteStatus(){
            error_log("ADMIN_ANFI::deleteStatus-> Inicio");
            if(!empty($_POST)){
                if($_POST['action'] == 'delStatus'){
                    if(!empty($_POST['idUsuario']) ){
                        $id            = $_POST['idUsuario'];
                        $userModel     = new userModel();
    
                        if($userModel->delete($id)){
                            echo 'ok';
                            exit;
                        }else{
                            echo 'error';
                        }
                    }else{
                        
                        echo 'error';
                    }
                    exit;
                }
            }
            exit;
            
        }


        
    }
?>