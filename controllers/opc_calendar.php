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
        
        error_log("OPC_CALENDAR::construct() " . $this->user->getUserWhats());
        
        
    }

    //Muestra Vista, mandando datos de contratos y usuario logeado
     function render(){
        error_log("OPC_CALENDAR:: render()");

        
        $contractModel     = new ContractModel();
        $fechasAll         = $contractModel->getFechasBlock($this->house->getId());
        $fechasPend        = $this->getFechas(5);

        $this->view->render('anfitrion/opc_calendar', [
            'user'                => $this->user,
            'fechasAll'           => $fechasAll,
            'fechasPend'          => $fechasPend
        ]);
    }

    /*
    function create($params){
        $id = $params[0];
        $id2 = $params[1];
        error_log("OPC_CALENDAR:: delete() id = " . $id . "aa: " .$id2);
        $this->view->render('anfitrion/modalEditar', [
            "user" => $this->user
        ]);
    } */

    //Obtener un contrato especifico
    function getContract(){
        
        error_log("OPC_CALENDAR:: getContract()");
        
        if(!empty($_POST)){
            //extraer datos
            if($_POST['action'] == 'infoContrato'){
                
                $id = $_POST['contrato'];

                $res = [];
                
                $contractModel     = new ContractModel();
                $contract = $contractModel->getContract($id);
                
                
                echo json_encode($contract, JSON_UNESCAPED_UNICODE);
                
                exit;
            }
            echo 'error';
        }
        exit;
    }

    //Limpia la cadena para insertar un icono. Actualmente no esta en Uso, se cambio por EMOJIS
    function strClean($strcadena){
        $string = str_ireplace("<i class=","",$strcadena);
        $string = str_ireplace("></i>","",$string);
        $string = str_ireplace('"',"",$string);
        return $string;
    }
    
    //Actualiza un contrato especifico
    function updateContract(){
        
        error_log("OPC_CALENDAR:: updateContract()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'updateContract'){
                if(!empty($_POST['contNombreArren']) || !empty($_POST['contAPaterArren']) || !empty($_POST['contAMaterArren']) || !empty($_POST['contFechEntrada']) || !empty($_POST['contFechSalida']) || !empty($_POST['idContrato']) || !empty($_POST['idCasa']) ){

                    if($_POST['contFechEntrada'] < $_POST['contFechSalida']){
                        
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
                       
                            
                        $RES = $contractModel->verifyFechasBlock($contFechEntrada,$contFechSalida,$id,$idCasa);
                        
                        if($RES == 0){
                            $contractModel->setContNombreArren($contNombreArren);
                            $contractModel->setContAPaterArren($contAPaterArren);
                            $contractModel->setContAMaterArren($contAMaterArren);
                            $contractModel->setContFechEntrada($contFechEntrada);
                            $contractModel->setContFechSalida($contFechSalida);
                            $contractModel->setContMontoTotal($contTotal);
                            $contractModel->setId($id);

                            if($contractModel->update()){
                                
                                $contractModelUp = new ContractModel();
                                $contract = $contractModelUp->getContract($id);
                                echo json_encode($contract, JSON_UNESCAPED_UNICODE);
                                
                                exit;
                            }else{
                               
                            }
                        }else{
                            echo json_encode("errorFechaCoin", JSON_UNESCAPED_UNICODE);
                            exit;
                        }
                    }
                    echo json_encode(errorFecha, JSON_UNESCAPED_UNICODE);
                    exit;
                }else{
                    echo 'error';
                }
                exit;
            }
        }
        exit;
        
    }


    //Eliminar un contrato especifico
    function deleteContract(){
        error_log("OPC_CALENDAR:: deleteContract()");

        if(!empty($_POST)){
            if($_POST['action'] == 'delContract'){
                if(!empty($_POST['idContrato']) ){
                    $id                = $_POST['idContrato'];
                    $contractModel     = new ContractModel();

                    if($contractModel->delete($id)){
                        echo 'ok';
                        exit;
                    }else{
                        echo 'error';
                    }
                }else{
                    echo 'error';
                }
                exit;
            }
        }
        exit;
        
    }

    //Obtener Contratos pendientes en las proximas fechas
    private function getFechas($n = 0){
        if($n < 0) return NULL;
        $contractModel     = new ContractModel();
        return $contractModel->getFechasPend($this->house->getId(), $n);   
    }

    //Obtener contratos de una especifica Casa
    function getHistoryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $contractModel     = new ContractModel();
        $contracts = $contractModel->get($this->house->getId());

        foreach ($contracts as $contract) {
            array_push($res, $contract->toArray());
        }
        
        
        echo json_encode($res);

    }


    //Elimina un Contrato
    function delete($params){
        error_log("OPC_CALENDAR:: delete()");
        
        if($params === NULL) $this->redirect('opc_calendar', ['error'=> ErrorMessages::ERROR_CONTRACT_DELETE]);
        $id = $params[0];
        
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