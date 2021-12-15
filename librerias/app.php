<?php

    require_once 'controllers/errores.php';

    class App{
        //Constructor
        function __construct(){
            //Validar si existe una URL
            $url = isset($_GET['url']) ? $_GET['url'] : null; //si existe una URL añadir a la variable "url", si no NULO
            $url = rtrim($url,'/'); //borra "/" que se encuentre al final (lado derecho) de la URL
            $url = explode('/', $url); //Dividir la URL en un arreglo por cada "/" que encuentre, para asignar cada parte su Controlador o parametros

            //Si no hay Controlador, redirigir a Inicio
            if(empty($url[0])){
                error_log('APP::construct-> No hay controlador');
                $ArController = 'controllers/inicio.php'; //Carga por Default el controlador Inicio 
                require_once $ArController;//Llamamos al Controlador
                $controller = new Inicio();//Crear nueva Instancia
                $controller->loadModel('inicio');//Cargamos el Modelo
                $controller->render();//Renderiza la Vista
                return false;
            }
            //Si hay un Controlador, Carga el nombre del controlador
            $ArController = 'controllers/' . $url[0] . '.php';

            //Si existe Archivo
            if(file_exists($ArController)){
                require_once $ArController;//Llamar al Controlador

                $controller = new $url[0];//Nueva Instancia
                $controller->loadModel($url[0]);//Cargar Modelo

                //Si hay Metodo
                if(isset($url[1])){
                    //Si existe un Metodo 
                    if(method_exists($controller, $url[1])){
                        //Si hay Parametros
                        if(isset($url[2])){
                            //numero de parametros, se le resta dos: uno es el Controlador y Metodo
                            $npara = sizeof($url) - 2;
                            //arreglo de parametros
                            $params = [];

                            for($i = 0; $i< $npara; $i++){
                                array_push($params, $url[$i + 2]);
                            }
                            $controller->{$url[1]}($params);
                        }else{
                            //no hay parametors, se llama al metodo tal cual
                            $controller->{$url[1]}(); //metdo dinamico
                        }
                    }else{
                        //error, no exite metodo
                        $controller = new Errores();
                        //$controller->render();
                    }
                }else{
                    //no hay Metodo a cargar
                    $controller->render();
                }
            }else{
                //mandaria error
                $controller = new Errores();
                $controller->render();
            }
        }
    }
?>