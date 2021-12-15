<?php   

class Controller{
    function __construct(){
        $this-> view = new View();//para saber que Vista cargar
    }

    
    function loadModel($model){ //Se encarga de cargar el Arc. del modelo asociado
        $url = 'models/' . $model . 'model.php';//Url del archivo Modelo

        //Si Existe Archivo
        if(file_exists($url)){
            require_once $url;//Carga el archivo

            $modelName = $model.'Model';//Nombre del Modelo
            $this->model  = new $modelName;//Iniciar nueva Instancia
        }
    }

    function existPOST($params){ //Simplificacion de inserccion en la Base de datos
        foreach($params as $param){//Recorrer todos los Parametros
            if(!isset($_POST[$param])){ //Si no existe Parametros
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

        //Si se cumple un Proceso, mandar mensaje por URL para que la vista lo muestre
        foreach($mensajes as $key=>$mensaje){
            array_push($data, $key . '=' . $mensaje);
        }
        $params = join('&', $data); //une una areglo con algun caracter
        if($params  != ''){//Validar si no esta vacio
            $params = '?' . $params;
        }

        header('Location: ' . constant('URL') . '/' . $route . $params);//redirije cuando termine una accion
    
    }
}
?>