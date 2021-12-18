<?php

require_once 'models/housemodel.php';

    class Inicio extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('INICIO::construct-> Inicio Principal');
        }

        //Muestra vista, enviado informacion de la region de cada casa
        function render(){
            error_log('INICIO::render -> Carga el Index de Inicio');
            
            
            $this->view->render('inicio/index',[
                'ubications' => $this->getUbication()
            ]);
        }

        //Obtener todos los usuarios anfitriones
        function getHistoryJSON(){
            header('Content-Type: application/json');
            $res = [];
            $userModel     = new UserModel();
            $users = $userModel->getAnfiInicio();
    
            foreach ($users as $user) {
                array_push($res, $user->toArray());
            }
            
            
            echo json_encode($res);
    
        }

        //Muestra las casas disponibles en la region del visitante
        function busqRapi(){

            error_log("INICIO:: busqRapi()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos                  
    
                    $ubicacion = $input['ubicacion'];
    
                    error_log($ubicacion);
                    
                    $res = [];
                    
                    $houseModel = new HouseModel();
                        
                    $casas     = $houseModel->busqCasasRegion($ubicacion);
                   
                    
                    if(sizeof($casas) == 0){//No hay Contratos
                        
                        echo json_encode("NULO");
                    
                        exit;
                    }else{
                        foreach ($casas as $casa) {
                            array_push($res, $casa->toArray());
                        }
                        echo json_encode($res);
                    
                        exit;
                    }
                    
                    
               
            }
            echo '';
            exit;
            

        }

        //obtiene la region que hay en cada casa 
        private function getUbication(){
            $res = [];
            $houseModel = new HouseModel();
            $ubications = $houseModel->getAll();
        
            foreach ($ubications as $ubication) {
                array_push($res, str_replace(' ', '+', $ubication->getCasaRegion()) );
            }
            $res = array_values(array_unique($res));
        
            return $res;
        }

    }
?>