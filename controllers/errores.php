<?php

class Errores extends Controller{
    
    //Constructor extendido de Controller
    function __construct(){
        parent::__construct();
        error_log('Errores::construct -> Inicio de Errores');
    }

    //Visualiza Vista
    function render(){
        $this->view->render('errores/index');
    }
}
?>