<?php

require_once 'models/usermodel.php';
require_once 'models/contractmodel.php';
class opc_calendar extends SessionController{

    private $user;
    private $house;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        $this->house = $this->getHouseSessionData();
        
        error_log("Anfitrion::constructor() " . $this->user->getUserWhats());
        
        error_log("Anfitrion::constructor() " .  $this->house->getIdUsuario());
        
    }


     function render(){
        error_log("Anfitrion::RENDER() ");

        
        $contractModel     = new ContractModel();
        $fechasAll         = $contractModel->getFechasBlock($this->house->getId());
        $fechasPend        = $this->getFechas(5);

        $this->view->render('anfitrion/opc_calendar', [
            'user'                => $this->user,
            'fechasAll'           => $fechasAll,
            'fechasPend'          => $fechasPend
        ]);
    }

    function create($params){
        $id = $params[0];
        $id2 = $params[1];
        error_log("OPCCALENDAR::delete() id = " . $id . "aa: " .$id2);
        $this->view->render('anfitrion/modalEditar', [
            "user" => $this->user
        ]);
    } 

    function getContract(){
        
        error_log("opcCALENDAR: GETCONTRACT");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            //extraer datos
            if($_POST['action'] == 'infoContrato'){
                
                $id = $_POST['contrato'];

                $res = [];
                
                error_log("id: ". $id);
                $contractModel     = new ContractModel();
                $contract = $contractModel->getContract($id);
                
                
                echo json_encode($contract, JSON_UNESCAPED_UNICODE);
                error_log("CONSULTAR PRODUCTO ");
                exit;
            }
            echo 'error';
        }
        exit;
    }

    function strClean($strcadena){
        $string = str_ireplace("<i class=","",$strcadena);
        $string = str_ireplace("></i>","",$string);
        $string = str_ireplace('"',"",$string);
        return $string;
    }
    
    function updateContract(){
        
        error_log("opcCALENDAR: UPDATECONTRACT");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            if($_POST['action'] == 'updateContract'){
                if(!empty($_POST['contNombreArren']) || !empty($_POST['contAPaterArren']) || !empty($_POST['contAMaterArren']) || !empty($_POST['contFechEntrada']) || !empty($_POST['contFechSalida']) || !empty($_POST['idContrato']) || !empty($_POST['idCasa']) ){

                    if($_POST['contFechEntrada'] < $_POST['contFechSalida']){
                        error_log("FECHA CORRECTA");
                        $contNombreArren   = $_POST['contNombreArren'];
                        $contAPaterArren   = $_POST['contAPaterArren'];
                        $contAMaterArren   = $_POST['contAMaterArren'];
                        $contFechEntrada   = $_POST['contFechEntrada'];
                        $contFechSalida    = $_POST['contFechSalida'];
                        $idCasa            = $_POST['idCasa'];
                        $id                = $_POST['idContrato'];
                            
                        $contractModel     = new ContractModel();

                        $noDias = (strtotime($contFechSalida)-strtotime($contFechEntrada))/86400;

                       $contNombreLimpio = $this->strClean($contNombreArren);
                       $contTotal = $noDias * $this->house->getCasaRenta();
                        error_log('LIMPIO'.$noDias);
                            
                        $RES = $contractModel->verifyFechasBlock($contFechEntrada,$contFechSalida,$id,$idCasa);
                        
                        error_log('RESPUESTA '.$RES);
                        if($RES == 0){
                            $contractModel->setContNombreArren($contNombreArren);
                            $contractModel->setContAPaterArren($contAPaterArren);
                            $contractModel->setContAMaterArren($contAMaterArren);
                            $contractModel->setContFechEntrada($contFechEntrada);
                            $contractModel->setContFechSalida($contFechSalida);
                            $contractModel->setContMontoTotal($contTotal);
                            $contractModel->setId($id);

                            if($contractModel->update()){
                                //$this->view->render('login/index');
                                //$this->redirect('opc_calendar',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                                $contractModelUp = new ContractModel();
                                $contract = $contractModelUp->getContract($id);
                                echo json_encode($contract, JSON_UNESCAPED_UNICODE);
                                
                                exit;
                            }else{
                                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                                return; */
                                // $this->redirect('opc_calendar',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                            }
                        }else{
                            echo json_encode("errorFechaCoin", JSON_UNESCAPED_UNICODE);
                            exit;
                        }
                    }
                    echo json_encode(errorFecha, JSON_UNESCAPED_UNICODE);
                    exit;
                }else{
                    //$this->redirect('opc_calendar', ['error'=> ErrorMessages::ERROR_REGISTRO_VACIO]);
                    echo 'error';
                }
                exit;
            }
        }
        exit;
        
    }


    
    function deleteContract(){
        error_log("opcCALENDAR: DELETECONTRACT");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            if($_POST['action'] == 'delContract'){
                if(!empty($_POST['idContrato']) ){
                    $id                = $_POST['idContrato'];
                    $contractModel     = new ContractModel();

                    if($contractModel->delete($id)){
                        //$this->view->render('login/index');
                        //$this->redirect('opc_calendar',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                        echo 'ok';
                        exit;
                    }else{
                        /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                        return; */
                        //$this->redirect('opc_calendar',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                        echo 'error';
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

    private function getFechas($n = 0){
        if($n < 0) return NULL;
        $contractModel     = new ContractModel();
        return $contractModel->getFechasPend($this->house->getId(), $n);   
    }

    function getHistoryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $contractModel     = new ContractModel();
        $contracts = $contractModel->get($this->house->getId());

        foreach ($contracts as $contract) {
            array_push($res, $contract->toArray());
        }
        
        error_log("AAAAAAAAAAAAAAAAAAAA".$this->house->getId());
        
        echo json_encode($res);

    }


    function delete($params){
        error_log("OPCCALENDAR::delete()");
        
        if($params === NULL) $this->redirect('opc_calendar', ['error'=> ErrorMessages::ERROR_CONTRACT_DELETE]);
        $id = $params[0];
        error_log("OPCCALENDAR::delete() id = " . $id);
        
        $contractModel     = new ContractModel();
        $res = $contractModel->delete($id);

        if($res){
            $this->redirect('opc_calendar', ['success'=> SuccessMessages::SUCCESS_CONTRACT_DELETE]);
        }else{
            $this->redirect('opc_calendar', ['error'=> ErrorMessages::ERROR_CONTRACT_DELETE]);
        }
    }


    

}
?>