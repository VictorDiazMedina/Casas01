<?php

class View{

    function __construct(){
    }

    //Carga la Vista por Nombre, pasa información.
    function render($nombre, $data = []){
        $this->d = $data;//Pasa Informacion
        $this->handleMessages();
        require 'views/' . $nombre . '.php';//Carga el archivo de Vista
    }
    
    
    //Validacion si existen mensajes
    private function handleMessages(){
        if(isset($_GET['success']) && isset($_GET['error'])){
            // no se muestra nada porque no puede haber un "error" y "success" al mismo tiempo
        }else if(isset($_GET['success'])){  //Si Existe Success llamar a la funcion
            $this->handleSuccess();
        }else if(isset($_GET['error'])){
            $this->handleError();
        }
    }

    //Validacion por llave Error
    private function handleError(){
        if(isset($_GET['error'])){//Si esta declarado lo que contine GET
            $hash = $_GET['error'];//Obtener el GET
            $errors = new ErrorMessages();

            if($errors->existsKey($hash)){//Existe la llave en la lista de Errores
                error_log('View::handleError() existsKey =>' . $errors->get($hash));
                $this->d['error'] = $errors->get($hash);//Captura la informacion
            }else{
                $this->d['error'] = NULL;//Si no existe la llave, captura Nulo
            }
        }
    }


    //Validacion por llave Success, misma funcion de Errror
    private function handleSuccess(){
        if(isset($_GET['success'])){
            $hash = $_GET['success'];//obtener el GET
            $success = new SuccessMessages();

            if($success->existsKey($hash)){//Si existe la llave de Success
                error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
                $this->d['success'] = $success->get($hash);
            }else{
                $this->d['success'] = NULL;
            }
        }
    }

    //Mostrar mensajes en la Vista
    public function showMessages(){
        $this->showError();
        $this->showSuccess();
    }

    //Muestra mensaje de Error
    public function showError(){
        if(array_key_exists('error', $this->d)){
            echo '<div class="error">'.$this->d['error'].'</div>';
        }
    }

    //Muestra mensaje de Success
    public function showSuccess(){
        if(array_key_exists('success', $this->d)){
            echo '<div class="success">'.$this->d['success'].'</div>';
        }
    }
}

?>