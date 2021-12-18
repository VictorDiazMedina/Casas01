<?php

require_once 'models/usermodel.php';
require_once 'models/adminmodel.php';

    class Admin_backup extends SessionController{


        function __construct(){
            parent::__construct();
            error_log('ADMIN::construct-> ADMIN_ANFI');
        }

        //Carga la Vista
        function render(){
            error_log('ADMIN::render -> Carga el Index de ADMIN');
            
            
            $this->view->render('ADMIN/admin_backup');
            
        }

        //Realiza la peticion de respaldo, lanzado un mensaje de exito o error
        function backup(){
            
            $adminModel     = new AdminModel();

            if($adminModel->backup()){
                $this->redirect('admin_backup',['success'=> SuccessMessages::SUCCESS_ADMIN_BACKUP]);
            }else{
                $this->redirect('admin_backup',['error'=> ErrorMessages::ERROR_ADMIN_BACKUP]);
            }
        }

        //Realiza la peticion de restauracion, recibiendo el archivo. 
        function restore(){
            
            if($this->existPOST(['archSelect'])){
                
                $archivoNombre = $this->getPost('archSelect');

                $adminModel     = new AdminModel();


                if($adminModel->restore($archivoNombre)){
                    
                    $this->redirect('admin_backup',['success'=> SuccessMessages::SUCCESS_ADMIN_RESTORE]);
                }else{
                   
                    $this->redirect('admin_backup',['error'=> ErrorMessages::ERROR_ADMIN_RESTORE]);
                }
            }else{
                
                $this->redirect('admin_backup',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
            }
        }

    
        
    }
?>