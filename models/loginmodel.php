<?php

require_once 'models/usermodel.php';

class LoginModel extends Model{

    function __constructor(){
        parent::__construct();

    }

    //Funcion para Iniciar sesión por numero telefonico y contraseña
    function login($userWhats, $userPass){
        try{
            $query = $this->prepare('SELECT * FROM Usuario WHERE user_WhatsApp = :userWhats');
            $query->execute(['userWhats' => $userWhats]);

            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC);
                $user = new UserModel();
                $user->from($item);

                if(password_verify($userPass, $user->getUserPass())){
                    error_log('LOGIN_MODEL::login ->success ');
                    return $user;
                }else{
                    error_log('LOGIN_MODEL::login -> Password No Igual ');
                    return NULL; 
                }
            }
        }catch(PDOexception $e){
            error_log('LOGIN_MODEL::login ->exception '.$e);
            return NULL;
        }
    }
}
?>