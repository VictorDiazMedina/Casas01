<?php

require_once 'models/housemodel.php';

    class Login extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('LOGIN::construct-> Inicio de Login');
        }

        function render(){
            error_log('LOGIN::render -> Carga el Index de Login');
            $actual_link = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actual_link);
            $this->view->errorMessage = '';
            $this->view->render('login/index');
        }

        function authenticate(){
            if($this->existPOST(['userWhats', 'userPass'])){
                $userWhats = $this->getPOST('userWhats');
                $userPass = $this->getPOST('userPass');

                if($userWhats == '' || empty($userWhats) || $userPass == '' || empty($userPass)){
                    // error al validar datos
                    //$this->errorAtSignup('Campos vacios');
                    $this->redirect('login', ['error'=> ErrorMessages::ERROR_LOGIN_AUTHEN_VACIO]);
                    return;
                }

                $user = $this->model->login($userWhats, $userPass);
                if($user != NULL){
                    if($user->getUserStatus() == 1){
                        $this->initialize($user);
                    }else{
                        $this->redirect('waitingtime');
                    }
                    
                }else{
                    $this->redirect('login', ['error'=> ErrorMessages::ERROR_LOGIN_AUTHEN_INCORRECT]);
                    return;
                }
            }else{
                $this->redirect('login', ['error'=> ErrorMessages::ERROR_LOGIN_AUTHEN_ERROR]);
                
            }
        }


    }
?>