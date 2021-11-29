<?php

require_once 'models/housemodel.php';

    class Inicio extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('INICIO::construct-> Inicio Principal');
        }

        function render(){
            error_log('INICIO::render -> Carga el Index de Inicio');
            
            
            $this->view->render('inicio/index',[
                'ubications' => $this->getUbication()
            ]);
        }

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

        function busqRapi(){

            error_log("HOUSECONTRACT: DATAHOUSE()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                error_log("NO VIENE VACIO");
                //extraer datos
                    error_log("EXTRAER DATOS");
                    
    
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