<?php

    require_once 'controllers/errores.php';

    class App{
        function __construct(){
            $url = isset($_GET['url']) ? $_GET['url'] : null; //si existe una RL añadir la URL, si no Nulo
            $url = rtrim($url,'/'); //borrar culquier /
            $url = explode('/', $url); //Dividir la URL en un arreglo por cada / que encuentre

            if(empty($url[0])){
                error_log('APP::construct-> No hay controlador');
                $ArController = 'controllers/inicio.php';
                require_once $ArController;
                $controller = new Inicio();
                $controller->loadModel('inicio');
                $controller->render();
                return false;
            }
            $ArController = 'controllers/' . $url[0] . '.php';

            if(file_exists($ArController)){
                require_once $ArController;

                $controller = new $url[0];
                $controller->loadModel($url[0]);

                if(isset($url[1])){
                    if(method_exists($controller, $url[1])){
                        if(isset($url[2])){
                            //no parametros
                            $npara = sizeof($url) - 2;
                            //arreglo de param
                            $params = [];

                            for($i = 0; $i< $npara; $i++){
                                array_push($params, $url[$i + 2]);
                            }
                            $controller->{$url[1]}($params);
                        }else{
                            //no hay parametors, se llama al metodo tsal cual
                            $controller->{$url[1]}(); //metdo dinamico
                        }
                    }else{
                        //error, no exite metodo
                        $controller = new Errores();
                        //$controller->render();
                    }
                }else{
                    //no hay metodo a cargar
                    $controller->render();
                }
            }else{
                //mandaria error
                $controller = new Errores();
                //$controller->render();
            }
        }
    }
?>