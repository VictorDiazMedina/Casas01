<?php

require_once 'models/housemodel.php';

    class Waitingtime extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Waitingtime::construct-> Inicio de Waitingtime');
        }

        function render(){
            error_log('Waitingtime::render -> Carga el Index de Waitingtime');
            
            $this->view->render('login/waitingtime');
        }

       


    }
?>