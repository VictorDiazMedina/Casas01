<?php   

class Controller{
    function __construct(){
        $this-> view = new View();//para saber que vista cargar

    }

    function loadModel($model){ //Se encarga de cargar el Arc. del modelo asociado
        $url = 'models/' . $model . 'model.php';

        if(file_exists($url)){
            require_once $url;

            $modelName = $model.'Model';
            $this->model  = new $modelName;
        }
    }

    function existPOST($params){ //Simplifficacion de inserccion en la Bse de datos
        foreach($params as $param){
            if(!isset($_POST[$param])){
                error_log('CONTROLLER::existsPost -> No existe el parametro ' . $param);
                return false;
            }
        }
        return true;
    }


    function existGET($params){ //Simplifficacion de inserccion en la Bse de datos
        foreach($params as $param){
            if(!isset($_GET[$param])){
                error_log('CONTROLLER::existsGet -> No existe el parametro ' . $param);
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    function redirect($route, $mensajes=[]){//cuando haya un error o se cumple un proceso, se redirije a una pagina
        $data = [];
        $params = '';

        foreach($mensajes as $key=>$mensaje){
            array_push($data, $key . '=' . $mensaje);
        }
        $params = join('&', $data); //une una areglo con algun caracter
        if($params  != ''){
            $params = '?' . $params;
        }

        header('Location: ' . constant('URL') . '/' . $route . $params);//redirije cuando termine una accion
    
    }
}
?>