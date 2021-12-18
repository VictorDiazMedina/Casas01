<?php

class Session{
    
    private $sessionName = 'user'; 

    public function __construct(){
        
        //Si no existe una sesion la iniciemos, 
        //de lo contrario no hara sessionSTART
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    //Colocar nuestro usuario actual
    public function setCurrentUser($user){
        $_SESSION[$this->sessionName] = $user;
    }

    //Para obtener el usuario actual
    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }

    //Destruir Sesion
    public function  closeSession(){
        session_unset();
        session_destroy();
    }

    //Verificar si existe una Sesion
    public function exists(){
        return isset($_SESSION[$this->sessionName]);
    }
}
?>