<?php

require_once 'models/housemodel.php';
require_once 'models/contractmodel.php';
require_once 'models/photomodel.php';

    class Houses extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('HOUSES::construct');
        }

        //Muestra Vista
        function render(){
            error_log('HOUSES::render');
            
            
            $this->view->render('inicio/houses',[
            ]);
        }
 

        //Realiza la busqueda rapida, mostrando las casas disponibles
        function busqRapids(){
            
            error_log("HOUSES: busqRapids()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                
                //extraer datos
                if($input['action'] == 'busqRapid'){
                    
                    $ubicacion = str_replace('+', ' ', $input['ubicacion']);
                    $llegada   = $input['llegada'];
                    $salida    = $input['salida'];
    
                    
                    
                    $res = [];
                    
                    $houseModel = new HouseModel();
                    $contractModel = new ContractModel();

                    $noContratos = $contractModel->busqRapid($llegada, $salida);
                    
                    
                    if(sizeof($noContratos) == 0){//No hay Contratos
                        
                        $casas     = $houseModel->busqCasasRegion($ubicacion);
                    }else{
                        $casas     = $houseModel->busqRapid($ubicacion, $llegada, $salida);
                    }

                    
                    
                    foreach ($casas as $casa) {
                        array_push($res, $casa->toArray());
                    }
                    
                    
                    echo json_encode($res);
                    exit;
                }else{
                    
                    //extraer datos
                    
                        
                        $res = [];
                        
                        $houseModel = new HouseModel();
    
                        $casas     = $houseModel->getCasas();
                        
                        foreach ($casas as $casa) {
                            array_push($res, $casa->toArray());
                        }
                        
                        
                        echo json_encode($res);
                        exit;
                }
                echo 'error';
            }
            exit;

        }
        
        //Busqueda de fotografias por casa para cada casa disponible por la funcion busqRapids()
        function busqGallery(){
        
            error_log("HOUSES: busqGallery()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);
            
            if(!empty($input)){
                //extraer datos
                
                $casas = $input['casas'];
                $place_holders = implode(',', array_fill(0, count($input['casas']), '?'));
                
                $res = [];
                
                
                for($i = 0; $i < count($casas); ++$i) {
                        
                    $photoModel = new PhotoModel();
                    $cas     = $photoModel->busqCasas($casas[$i]);
                    
                    foreach ($cas as $casa) {
                        array_push($res, $casa->toArray());
                    }
                    
                }

                echo json_encode($res);
                exit;
                
            }
            exit;
            
        }


        
    }
?>