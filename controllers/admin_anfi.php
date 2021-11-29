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

        function render(){
            error_log('ADMIN::render -> Carga el Index de ADMIN');
            
            
                
                
            $this->house    = new HouseModel();
            $this->usesr     = new UserModel();

           
            $anfitriones = $this->usesr->getAnfi();
            
            $this->view->render('ADMIN/admin_anfi',[                   
                'anfitriones'           => $anfitriones
                ]);
            
        }

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

        function getUser(){
        
            error_log("opcCALENDAR: GETUser");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                //extraer datos
                if($_POST['action'] == 'infoUser'){
                    
                    $id = $_POST['user'];
    
                    $res = [];
                    
                    error_log("id: ". $id);
                    $userModel     = new UserModel();
                    $user          = $userModel->getUser($id);
                    
                    
                    echo json_encode($user, JSON_UNESCAPED_UNICODE);
                    error_log("CONSULTAR PRODUCTO ");
                    exit;
                }
                echo 'error';
            }
            exit;
        }

        function updateStatus(){
        
            error_log("opcCALENDAR: UPDATESTATUS");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                if($_POST['action'] == 'updateStatus'){
                    
                    error_log("STATUS");
                    $userStatus   = $_POST['options'];
                    $id                = $_POST['idUsuario'];
                        
                    $userModel     = new UserModel();


                    $userModel->setUserStatus($userStatus);
                    $userModel->setId($id);

                    if($userModel->updateStatus()){
                        //$this->view->render('login/index');
                        //$this->redirect('opc_calendar',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                        
                        echo json_encode('ok', JSON_UNESCAPED_UNICODE);
                        
                        exit;
                    }else{
                        /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                        return; */
                        // $this->redirect('opc_calendar',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                    }
                            
                       
                   
                }
            }
            exit;
            
        }

        function deleteStatus(){
            error_log("ADMIN_ANFI: DELETEuser");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                if($_POST['action'] == 'delStatus'){
                    if(!empty($_POST['idUsuario']) ){
                        $id                = $_POST['idUsuario'];
                        $userModel     = new userModel();
    
                        if($userModel->delete($id)){
                            //$this->view->render('login/index');
                            //$this->redirect('opc_calendar',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                            echo 'ok';
                            exit;
                        }else{
                            /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                            return; */
                            //$this->redirect('opc_calendar',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                            echo 'error';
                        }
                    }else{
                        //$this->redirect('opc_calendar', ['error'=> ErrorMessages::ERROR_REGISTRO_VACIO]);
                        echo 'error';
                    }
                    exit;
                }
            }
            exit;
            
        }


        
    }
?>