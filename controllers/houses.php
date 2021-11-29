<?php

require_once 'models/housemodel.php';
require_once 'models/contractmodel.php';
require_once 'models/photomodel.php';

    class Houses extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('INICIO::construct-> Inicio Principal');
        }

        function render(){
            error_log('INICIO::render -> Carga el Index de Inicio');
            
            
            $this->view->render('inicio/houses',[
            ]);
        }

        

        function busqRapids(){
            
            error_log("HOUSES: BUSQRAPIDs()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                error_log("NO VIENE VACIO");
                //extraer datos
                if($input['action'] == 'busqRapid'){
                    error_log("EXTRAER DATOS");
                    $ubicacion = str_replace('+', ' ', $input['ubicacion']);
                    $llegada   = $input['llegada'];
                    $salida    = $input['salida'];
    
                    error_log("0000". $ubicacion);
                    
                    $res = [];
                    
                    $houseModel = new HouseModel();
                    $contractModel = new ContractModel();

                    $noContratos = $contractModel->busqRapid($llegada, $salida);
                    //$casas     = $houseModel->busqCasas($noCasas);
                    
                    if(sizeof($noContratos) == 0){//No hay Contratos
                        
                        $casas     = $houseModel->busqCasasRegion($ubicacion);
                    }else{
                        $casas     = $houseModel->busqRapid($ubicacion, $llegada, $salida);
                    }

                    
                    /*$noCasas = $contractModel->busqRapid($llegada, $salida);

                    if(sizeof($noCasas) == 0){//No hay casas disponibles
                        $casas     = $houseModel->getCasas();
                    }else{
                        $casas     = $houseModel->busqCasas($noCasas);
                    }
                    */
                    
                    foreach ($casas as $casa) {
                        array_push($res, $casa->toArray());
                    }
                    
                    
                    echo json_encode($res);
                    exit;
                }else{
                    error_log("VIENE VACIO");
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
        
        function busqGallery(){
        
            error_log("HOUSES: BUSQGallery()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);
            
            if(!empty($input)){
                error_log("NO VIENE VACIO GALLERY");
                //extraer datos
                error_log("EXTRAER DATOS GALLERY");
                $casas = $input['casas'];
                $place_holders = implode(',', array_fill(0, count($input['casas']), '?'));
                

                
                $res = [];
                //$noCasas = rtrim($noCasas, ",");
                
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