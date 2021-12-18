<?php

require_once 'models/housemodel.php';
require_once 'models/photomodel.php';
require_once 'models/servicemodel.php';
require_once 'models/clausemodel.php';

    class Houseaccept extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('HOUSEACCEPT::construct-> Inicio');
        }

        //Mostrar Vista
        function render(){
            error_log('HOUSEACCEPT::render');
            
            
            $this->view->render('inicio/houseaccept',[
            ]);
        }

        


        
    }
?>