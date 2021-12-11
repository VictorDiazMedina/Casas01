<?php

require_once 'models/housemodel.php';
require_once 'models/contractmodel.php';
require_once 'models/usermodel.php';
require_once 'models/promotionmodel.php';

    class Admin_report extends SessionController{
        private $user;
        private $house;
        private $usesr;
        private $contract;

        function __construct(){
            parent::__construct();
            error_log('ADMIN::construct-> ADMIN_ANFI');
        }

        function render(){
            error_log('ADMIN::render -> Carga el Index de ADMIN');
            
            
                
                
            $this->house       = new HouseModel();
            $this->usesr       = new UserModel();            
            $this->contract    = new ContractModel();

           
            $meses             = $this->getMes();
            $contratos         = $this->contract->getContratos();
            $colorTiempo       = $this->getColorTiempo($meses);
            $labelsTiempo      = $this->getLabelsTiempo($meses, $contratos, $colorTiempo);

            $casas             = $this->contract->getRentas();
            $colorRentas       = $this->getColorTiempo($casas);
            $labelsRentas      = $this->getLabelsRentas($casas, $colorRentas);
            $rentas            = $this->getRentas($casas, $colorRentas);

            $estados           = $this->contract->getEstados();
            $colorEstados      = $this->getColorTiempo($estados);
            $labelsEstados     = $this->getLabelsEstados($estados, $colorEstados);
            $estadoss          = $this->getEstados($estados, $colorEstados);


            $anfitriones = $this->usesr->getAnfi();
            
            $this->view->render('ADMIN/admin_report',[                   
                'meses'           => $meses,
                'contratos'       => $contratos,
                'colorTiempo'     => $colorTiempo,
                'labelsTiempo'    => $labelsTiempo,
                'rentas'          => $rentas,
                'labelsRentas'    => $labelsRentas,
                'colorRentas'     => $colorRentas,
                'estados'         => $estadoss,
                'labelsEstados'   => $labelsEstados,
                'colorEstados'    => $colorEstados
                ]);
            
        }
        
        function getShortMes($meses){
            $res = [];
    
            for ($x = 0; $x < count($meses); $x++) {
               
              if($meses[$x] == "enero"){
                 $meses[$x] = "Ene";
               }
               if($meses[$x] == "febrero"){
                $meses[$x] = "Feb";
               } 
               if($meses[$x] == "marzo"){
                $meses[$x] = "Mar";
               }
               if($meses[$x] == "abril"){
                $meses[$x] = "Abr";
               }
               if($meses[$x] == "mayo"){
                $meses[$x] = "May";
               }
               if($meses[$x] == "junio"){
                $meses[$x] = "Jun";
               }
               
               if($meses[$x] == "julio"){
                $meses[$x] = "Jul";
               }
               if($meses[$x] == "agosto"){
                $meses[$x] = "Ago";
               }
               if($meses[$x] == "septiembre"){
                $meses[$x] = "Sep";
               }
               
               if($meses[$x] == "octubre"){
                $meses[$x] = "Oct";
               }
               if($meses[$x] == "noviembre"){
                $meses[$x] = "Nov";
               }
               if($meses[$x] == "diciembre"){
                $meses[$x] = "Dic";
               }

            }
            return $meses;
        } 

        function getLabelsTiempo($meses, $contratos, $colorTiempo){
            //$shortMes = $this->getShortMes($meses);
            $res = [];
    
            for ($x = 0; $x < count($meses); $x++) {
               
                $mes = "[ ".$contratos[$x]." ] ".$meses[$x]; // marzo
                
                array_push($res, $mes);
            }
            return $res;
        }
        
        function getColorTiempo($meses){
            $res = [];
    
            for ($x = 0; $x < count($meses); $x++) {
               
                array_push($res, $color = $this->getColor());
            }
            
            return $res;
        }

        function getMes(){
            $res = [];
            $contractModel    = new ContractModel();
    
            $meses = $contractModel->getMes();
    
            for ($x = 0; $x < count($meses); $x++) {
               
                setlocale(LC_TIME, 'spanish');

                $fecha = DateTime::createFromFormat('!m', $meses[$x]);
                $mes = strftime("%B", $fecha->getTimestamp()); // marzo
                
                array_push($res, $mes);
            }
            return $res;
        }


        
        function getRentas($casas, $colorRentas){
            $res = [];
            $contractModel    = new ContractModel();
            
            
            for ($x = 0; $x < count($casas); $x++) {
                
                $obj = new stdClass();
                $obj->value = $casas[$x]->getContFechEntrada();
                $obj->color = $colorRentas[$x];
                $obj->label = $casas[$x]->getIdCas();
                array_push($res, $obj);
            }
            return $res;
        }

        function getLabelsRentas($casas, $colorRentas){
            //$shortMes = $this->getShortMes($meses);
            $res = [];
            
            for ($x = 0; $x < count($casas); $x++) {
               
                $mes = "[ ".$casas[$x]->getContFechEntrada()." ] ".$casas[$x]->getIdCas(); // marzo
                
                array_push($res, $mes);
            }
            var_dump($res);
            return $res;
        }

        function getEstados($estados, $colorEstados){
            $res = [];
            $contractModel    = new ContractModel();
            
            
            for ($x = 0; $x < count($estados); $x++) {
                
                $obj = new stdClass();
                $obj->value = $estados[$x]->getContFechEntrada();
                $obj->color = $colorEstados[$x];
                $obj->label = $estados[$x]->getIdCas();
                array_push($res, $obj);
            }
            return $res;
        }

        function getLabelsEstados($estados, $colorEstados){
            //$shortMes = $this->getShortMes($meses);
            $res = [];
            
            for ($x = 0; $x < count($estados); $x++) {
               
                $mes = "[ ".$estados[$x]->getContFechEntrada()." ] ".$estados[$x]->getIdCas(); // marzo
                
                array_push($res, $mes);
            }
            var_dump($res);
            return $res;
        }

        function getColor(){
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }


        function getDataCasasJSON(){
            header('Content-Type: application/json');
            $res = [];
            $houseModel     = new HouseModel();
            $houses = $houseModel->getAll();
    
            foreach ($houses as $house) {
                array_push($res, $house->toArray());
            }
            
            
            echo json_encode($res);
    
        }

        function getHistoryJSON(){
            header('Content-Type: application/json');
            $res = [];
            $promotionModel     = new PromotionModel();
            $promotions = $promotionModel->getAll();
    
            foreach ($promotions as $promotion) {
                array_push($res, $promotion->toArray());
            }
            
            
            echo json_encode($res);
    
        }

        function newPromo(){
            if($this->existPOST(['houseSelect', 'promo_Codigo', 'promo_Cantidad'])){
                
                $casaNombre = $this->getPost('houseSelect');
                $promoCodigo   = $this->getPost('promo_Codigo');
                $promoCantidad   = $this->getPost('promo_Cantidad');

                error_log("ADMIN::newPromo() " . $casaNombre );
                //validate data
                
                $promotionModel     = new PromotionModel();

                $promotionModel->setPromoCodigo($promoCodigo);
                $promotionModel->setPromoCantidad($promoCantidad);                
                $promotionModel->setIdCas($casaNombre);
    
    
    
                if($promotionModel->save()){
                    //$this->view->render('login/index');
                    $this->redirect('admin_report',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                }else{
                    /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                    return; */
                    $this->redirect('admin_report',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                }
    
    
    
            }else{
                // error, cargar vista con errores
                //$this->errorAtSignup('Ingresa nombre de usuario y promoCodigo');
                $this->redirect('admin_report',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
            }
        }

        function getPromo(){
        
            error_log("ADMIN_REPORT: GETPROMO");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                //extraer datos
                if($_POST['action'] == 'infoPromo'){
                    
                    $id = $_POST['promo'];
    
                    $res = [];
                    
                    $promotionModel     = new PromotionModel();
                    $promo         = $promotionModel->getPromo($id);
                    
                    
                    echo json_encode($promo, JSON_UNESCAPED_UNICODE);
                    error_log("CONSULTAR PRODUCTO ");
                    exit;
                }
                echo 'error';
            }
            exit;
        }


        function updatePromocion(){
        
            error_log("ADMIN_REPORT: UPDATEPROMOCION");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                if($_POST['action'] == 'updatePromo'){
                    if(!empty($_POST['promoCodigo']) || !empty($_POST['promoCantidad'])  || !empty($_POST['idPromocion']) || !empty($_POST['idCasa']) ){
    
                        
                        error_log("FECHA CORRECTA");
                        $promoCodigo   = $_POST['promoCodigo'];
                        $promoCantidad   = $_POST['promoCantidad'];
                        $idCasa            = $_POST['idCasa'];
                        $id                = $_POST['idPromocion'];
                            
                        $promotionModel     = new PromotionModel();


                        $promotionModel->setPromoCodigo($promoCodigo);
                        $promotionModel->setPromoCantidad($promoCantidad);
                        $promotionModel->setId($id);

                        if($promotionModel->update()){
                            //$this->view->render('login/index');
                            //$this->redirect('opc_calendar',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                            echo json_encode('ok', JSON_UNESCAPED_UNICODE);
                            
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
    
    
        
        function deletePromocion(){
            error_log("ADMIN_REPORT: DELETEPROMOCION");
            //print_r($_POST); exit;
            if(!empty($_POST)){
                if($_POST['action'] == 'delPromocion'){
                    if(!empty($_POST['idPromocion']) ){
                        $id                = $_POST['idPromocion'];
                        $promotionModel     = new PromotionModel();
    
                        if($promotionModel->delete($id)){
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
    
    
        
    }
?>