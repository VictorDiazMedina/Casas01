<?php

require_once 'models/housemodel.php';
require_once 'models/photomodel.php';
require_once 'models/servicemodel.php';
require_once 'models/clausemodel.php';

    class Houseaccept extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('INICIO::construct-> Inicio Principal');
        }

        function render(){
            error_log('INICIO::render -> Carga el Index de Inicio');
            
            
            $this->view->render('inicio/houseaccept',[
            ]);
        }

        


        
    }
?>