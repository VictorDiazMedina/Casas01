<?php


error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE

ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment

ini_set('log_errors', TRUE); // Error/Exception file logging engine.

ini_set("error_log", "C:/xampp/htdocs/casas01/php-error.log");
    
    error_log( "Principal" );

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