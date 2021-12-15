<?php

//Parte de Errores, facilitando el mostrado y notificacion de error. 
error_reporting(E_ALL); 
ini_set('ignore_repeated_errors', TRUE); 
ini_set('display_errors', FALSE); 
ini_set('log_errors', TRUE); 
ini_set("error_log", "C:/xampp/htdocs/casas01/php-error.log");
    
    error_log( "Principal" );

    //Cargar Archivos Base. 
    require_once 'librerias/database.php';
    require_once 'classes/errormessages.php';
    require_once 'classes/successmessages.php';
    require_once 'librerias/controller.php';
    require_once 'librerias/model.php';
    require_once 'librerias/view.php';    
    require_once 'classes/sessionController.php';
    require_once 'librerias/app.php';

    require_once 'config/config.php';
    
    $app = new App();

?>