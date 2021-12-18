<?php

require_once 'models/housemodel.php';
require_once 'models/photomodel.php';
require_once 'models/servicemodel.php';
require_once 'models/clausemodel.php';
require_once 'models/contractmodel.php';
require_once 'models/promotionmodel.php';

    class Housecontract extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('HOUSECONTRACT::construct');
        }

        function render(){
            error_log('HOUSECONTRACT::render');
            
            $this->view->render('inicio/housecontract',[
            ]);
        }

        //Obtener datos de contratos
        function dataFechas(){
            
            error_log("HOUSECONTRACT: dataFechas()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    $contractModel     = new ContractModel();
                    $res      = $contractModel->getFechasBlock2($idCasa);
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo '';
            exit;

        }

        //Aplicar promocion a un contrato
        function applyPromocion(){
        
            error_log("HOUSECONTRACT: applyPromocion()");
            
            if(!empty($_POST)){
                if($_POST['action'] == 'updatePromo'){
                    if(!empty($_POST['promoCodigo']) || !empty($_POST['idPromocion'])  ){
    
                        
                        error_log("FECHA CORRECTA");
                        $promoCodigo       = $_POST['promoCodigo'];
                        $id                = $_POST['idPromocion'];
                            
                        $promotionModel    = new PromotionModel();



                        if($promotionModel->exists($promoCodigo, $id)){
                            $promotionModels     = new PromotionModel();


                            $res = $promotionModels->getPromoCanti($promoCodigo, $id);
                            
                            echo json_encode($res, JSON_UNESCAPED_UNICODE);
                            
                            exit;
                        }else{
                            echo json_encode('error', JSON_UNESCAPED_UNICODE);
                            
                            exit;
                        }
                            
                        
                    }else{
                        echo 'error';
                    }
                    exit;
                }
            }
            exit;
            
        }

        //Verificar si hay promocion de una casa
        function getPromoJSON(){
            
            error_log("HOUSECONTRACT: getPromoJSON()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    
                    
                    $promotionModel     = new PromotionModel();
                    $res      = $promotionModel->getPromoCasa($idCasa);
                    if(empty ( $res )){
                        echo json_encode('NULO');
                    }else {
                        echo json_encode($res);
                    }
                    exit;
               
            }
            echo '';
            exit;

        }
        
        //Obtener datos de una casa
        function dataHouse(){
            
            error_log("HOUSECONTRACT: dataHouse()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    
                    $res = [];
                    
                    $houseModel = new HouseModel();

                    $casa = $houseModel->get($idCasa);
                    array_push($res, $casa->toArray());
                    
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo 'error';
            exit;

        }

        //Captura de datos para realizar un nuevo contrato
        function newContract(){
            
            if($this->existPOST(['userNomb', 'userAp', 'userAm'])){
                
                $userNomb = $this->getPost('userNomb');
                $userAp   = $this->getPost('userAp');
                $userAm   = $this->getPost('userAm');                
                $ine      = $this->getPost('userINE');
                $FechE    = $this->getPost('FechE');
                $FechS    = $this->getPost('FechS');
                $renta    = $this->getPost('renta');
                $anticipo = $this->getPost('anticipo');
                $total    = $this->getPost('total');
                $idCasa   = $this->getPost('idCasa');

               
                $houseModel     = new HouseModel();
                $idCasaURL  = strval($houseModel->getIdCasa($idCasa));
                
               
                //validate data
                if($idCasa == '' || empty($idCasa) || $anticipo == '' || empty($anticipo) || $renta == '' || empty($total) || $total == '' || empty($renta) || $FechS == '' || empty($FechS) || $FechE == '' || empty($FechE) || $userNomb == '' || empty($userNomb) || $userAp == '' || empty($userAp) || $userAm == '' || empty($userAm)){
                    // error al validar datos
                    $this->redirectModif('housecontract',['error'=> ErrorMessages::ERROR_REGISTRO_VACIO],'&idCasa='.$idCasaURL.'');
                    
                    return;
                }
                date_default_timezone_set('UTC');
                date_default_timezone_set("America/Mexico_City");
                $date = date('Y-m-d');  

                $contractModel     = new ContractModel();

                $contractModel ->setContFechAct($date);
                $contractModel ->setContNombreArren($userNomb);
                $contractModel ->setContAPaterArren($userAp);
                $contractModel ->setContAMaterArren($userAm);                
                $contractModel ->setContINE($ine);
                $contractModel ->setContFechEntrada($FechE);
                $contractModel ->setContFechSalida($FechS);
                $contractModel ->setContAnticipo($anticipo);
                $contractModel ->setContMontoTotal($total);

                $contractModel ->setIdCas($idCasa);
    
                if($contractModel->save()){
                    $contracttModel     = new ContractModel();
                    $idContract  = strval($contracttModel->getIdContract($userNomb,$userAp,$userAm,$FechE,$FechS,$idCasa));
                    $this->redirect('houseaccept?idCasa='.$idContract.'&',['success'=> SuccessMessages::SUCCESS_CONTRATO_SUCCESS]);
                    
                }else{
                    
                    $this->redirectModif('housecontract',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR], '&idCasa='.$idCasaURL.'');
                }
                
    
                
            }else{
                
                $this->redirect('housecontract',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
            }
        }
        


        
    }
?>