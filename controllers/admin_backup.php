<?php

require_once 'models/usermodel.php';
require_once 'models/adminmodel.php';

    class Admin_backup extends SessionController{


        function __construct(){
            parent::__construct();
            error_log('ADMIN::construct-> ADMIN_ANFI');
        }

        function render(){
            error_log('ADMIN::render -> Carga el Index de ADMIN');
            
            
            $this->view->render('ADMIN/admin_backup');
            
        }

        function backup(){
            
            $adminModel     = new AdminModel();


            if($adminModel->backup()){
                //$this->view->render('login/index');
                $this->redirect('admin_backup',['success'=> SuccessMessages::SUCCESS_ADMIN_BACKUP]);
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('admin_backup',['error'=> ErrorMessages::ERROR_ADMIN_BACKUP]);
            }
        }

        function restore(){
            
            if($this->existPOST(['archSelect'])){
                
                $archivoNombre = $this->getPost('archSelect');

                $adminModel     = new AdminModel();


                if($adminModel->restore($archivoNombre)){
                    //$this->view->render('login/index');
                    $this->redirect('admin_backup',['success'=> SuccessMessages::SUCCESS_ADMIN_RESTORE]);
                }else{
                    /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                    return; */
                    $this->redirect('admin_backup',['error'=> ErrorMessages::ERROR_ADMIN_RESTORE]);
                }
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('admin_backup',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
            }
        }

    
        
    }
?>