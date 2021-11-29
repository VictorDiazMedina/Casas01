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
            error_log('INICIO::construct-> Inicio Principal');
        }

        function render(){
            error_log('INICIO::render -> Carga el Index de Inicio');
            
            $this->view->render('inicio/housecontract',[
            ]);
        }

        
        function dataFechas(){
            
            error_log("HOUSECONTRACT: DATAHOUSE()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                error_log("NO VIENE VACIO");
                //extraer datos
                    error_log("EXTRAER DATOS");
                    $idCasa = $input['idCasa'];
    
                    
                    
                    $contractModel     = new ContractModel();
                    $res      = $contractModel->getFechasBlock2($idCasa);
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo '';
            exit;

        }


        function applyPromocion(){
        
            error_log("HOUSECONTRACT: applyPromocion");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                if($_POST['action'] == 'updatePromo'){
                    if(!empty($_POST['promoCodigo']) || !empty($_POST['idPromocion'])  ){
    
                        
                        error_log("FECHA CORRECTA");
                        $promoCodigo   = $_POST['promoCodigo'];
                        $id                = $_POST['idPromocion'];
                            
                        $promotionModel     = new PromotionModel();



                        if($promotionModel->exists($promoCodigo, $id)){
                            //$this->view->render('login/index');
                            //$this->redirect('opc_calendar',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                            $promotionModels     = new PromotionModel();


                            $res = $promotionModels->getPromoCanti($promoCodigo, $id);
                            
                            echo json_encode($res, JSON_UNESCAPED_UNICODE);
                            
                            exit;
                        }else{
                            /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                            return; */
                            // $this->redirect('opc_calendar',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                            echo json_encode('error', JSON_UNESCAPED_UNICODE);
                            
                            exit;
                        }
                            
                        
                    }else{
                        //$this->redirect('opc_calendar', ['error'=> ErrorMessages::ERROR_REGISTRO_VACIO]);
                        echo 'error';
                    }
                    exit;
                }
            }
            exit;
            
        }

        function getPromoJSON(){
            
            error_log("HOUSECONTRACT: DATAHOUSE()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                error_log("NO VIENE VACIO");
                //extraer datos
                    error_log("EXTRAER DATOS");
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
        
        function dataHouse(){
            
            error_log("HOUSECONTRACT: DATAHOUSE()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                error_log("NO VIENE VACIO");
                //extraer datos
                    error_log("EXTRAER DATOS");
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

        function newContract(){
            if($this->existPOST(['userNomb', 'userAp', 'userAm'])){
                
                $userNomb = $this->getPost('userNomb');
                $userAp   = $this->getPost('userAp');
                $userAm   = $this->getPost('userAm');                
                $ine   = $this->getPost('userINE');
                $FechE   = $this->getPost('FechE');
                $FechS   = $this->getPost('FechS');
                $renta   = $this->getPost('renta');
                $anticipo   = $this->getPost('anticipo');
                $total   = $this->getPost('total');
                $idCasa   = $this->getPost('idCasa');
                
                error_log("Anfitrion::updateUser() " . $userNomb);
                
                error_log("Anfitrion::updateUser() " . $renta);
                
                error_log("Anfitrion::updateUser() " . $total);
                //validate data
                if($idCasa == '' || empty($idCasa) || $anticipo == '' || empty($anticipo) || $renta == '' || empty($total) || $total == '' || empty($renta) || $FechS == '' || empty($FechS) || $FechE == '' || empty($FechE) || $userNomb == '' || empty($userNomb) || $userAp == '' || empty($userAp) || $userAm == '' || empty($userAm)){
                    // error al validar datos
                    //$this->errorAtSignup('Campos vacios');
                    $this->redirect('housecontract', ['error'=> ErrorMessages::ERROR_REGISTRO_VACIO]);
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
                    //$this->view->render('login/index');
                    $contracttModel     = new ContractModel();
                    $idContract  = strval($contracttModel->getIdContract($userNomb,$userAp,$userAm,$FechE,$FechS,$idCasa));
                    
                    $this->redirect('houseaccept?idCasa='.$idContract.'&',['success'=> SuccessMessages::SUCCESS_CONTRATO_SUCCESS]);
                    
                }else{
                    /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                    return; */
                    $this->redirect('housecontract',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                }
                
    
                
            }else{
                // error, cargar vista con errores
                //$this->errorAtSignup('Ingresa nombre de usuario y userAp');
                $this->redirect('housecontract',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
            }
        }
        


        
    }
?>