<?php

require_once 'models/housemodel.php';
require_once 'models/photomodel.php';
require_once 'models/servicemodel.php';
require_once 'models/contractmodel.php';
require_once 'models/usermodel.php';
require_once 'models/clausemodel.php';

    class ContractPDF extends SessionController{
        private $contract;
        private $house;
        private $user;

        function __construct(){
            parent::__construct();
            error_log('CONTRACTPDF::construct');
        }

        //Mostrar Vistam eviando datos para generar el contrato
        function render(){
            error_log('CONTRACTPDF::render');
            
            if($this->existPOST(['casa'])){
            
                $idCont = $this->getPost('casa');
                
                $this->contract = new ContractModel();
                $this->house    = new HouseModel();
                $this->user     = new UserModel();

                $contrato  = $this->contract->getC($idCont);
                $casa      = $this->house->getH($this->contract->getIdCas());
                $anfitrion = $this->user->getU($this->house->getIdUsuario());
                
                $this->view->render('inicio/contractPDF',[
                    'contrato'            => $contrato,
                    'casa'                => $casa,                    
                    'anfitrion'           => $anfitrion
                 ]);
            }
        }

        


        
    }
?>