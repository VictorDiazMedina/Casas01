<?php

class Session{
    
    private $sessionName = 'user';

    public function __construct(){
        
        //Si no existe un sesion la iniciemos, 
        //de lo contrario no hara sessionSTART
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    //Colocar nuestro usuario actual
    public function setCurrentUser($user){
        $_SESSION[$this->sessionName] = $user;
    }

    //Para obtener el usuario
    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }

    //Destruir Sesion
    public function  closeSession(){
        session_unset();
        session_destroy();
    }

    public function exists(){
        return isset($_SESSION[$this->sessionName]);

    }
}
?>