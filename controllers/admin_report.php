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

        //Carga la vista, mandando informacion 
        function render(){
            error_log('ADMIN::render -> Carga el Index de ADMIN');
            
            
                
                
            $this->house       = new HouseModel();
            $this->usesr       = new UserModel();            
            $this->contract    = new ContractModel();

            //datos para el reporte por Mes
            $meses             = $this->getMes();
            $contratos         = $this->contract->getContratos();
            $colorTiempo       = $this->getColorTiempo($meses);
            $labelsTiempo      = $this->getLabelsTiempo($meses, $contratos, $colorTiempo);

            //datos para el reporte por Casas
            $casas             = $this->contract->getRentas();
            $colorRentas       = $this->getColorTiempo($casas);
            $labelsRentas      = $this->getLabelsRentas($casas, $colorRentas);
            $rentas            = $this->getRentas($casas, $colorRentas);

            //datos para el reporte por Estados
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
        
        //Convierte cada mes a su Acronimo
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

        //Inserta los datos en un arreglo, ejemplo: [5] Marzo
        function getLabelsTiempo($meses, $contratos, $colorTiempo){
            
            $res = [];
    
            for ($x = 0; $x < count($meses); $x++) {
               
                $mes = "[ ".$contratos[$x]." ] ".$meses[$x]; 
                
                array_push($res, $mes);
            }
            return $res;
        }
        
        //Obtener un color aleatorio por cada elemento del arreglo enviado
        function getColorTiempo($meses){
            $res = [];
    
            for ($x = 0; $x < count($meses); $x++) {
               
                array_push($res, $color = $this->getColor());
            }
            
            return $res;
        }

        //Obtener los datos de renta por Mes
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
        
        //Realizar un objeto por casa y su color
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

        //Inserta los datos en un arreglo, ejemplo: [5] Casa Verde
        function getLabelsRentas($casas, $colorRentas){
            $res = [];
            
            for ($x = 0; $x < count($casas); $x++) {
               
                $mes = "[ ".$casas[$x]->getContFechEntrada()." ] ".$casas[$x]->getIdCas(); 
                
                array_push($res, $mes);
            }
            var_dump($res);
            return $res;
        }

        //Realizar un objeto por Estado y su color
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

        //Inserta los datos en un arreglo, ejemplo: [5] Puebla
        function getLabelsEstados($estados, $colorEstados){
            $res = [];
            
            for ($x = 0; $x < count($estados); $x++) {
               
                $mes = "[ ".$estados[$x]->getContFechEntrada()." ] ".$estados[$x]->getIdCas(); 
                
                array_push($res, $mes);
            }
            var_dump($res);
            return $res;
        }

        //Obtener un color aleatorio
        function getColor(){
            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        //Obetener todas las Casas, y mandarlo en formato JSON
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

        //Obetener todas las Promociones, y mandarlo en formato JSON
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

        //Registro de una nueva Promocion
        function newPromo(){
            if($this->existPOST(['houseSelect', 'promo_Codigo', 'promo_Cantidad'])){
                
                $casaNombre = $this->getPost('houseSelect');
                $promoCodigo   = $this->getPost('promo_Codigo');
                $promoCantidad   = $this->getPost('promo_Cantidad');

                error_log("ADMIN_REPORT::newPromo() " . $casaNombre );
                
                
                $promotionModel     = new PromotionModel();

                $promotionModel->setPromoCodigo($promoCodigo);
                $promotionModel->setPromoCantidad($promoCantidad);                
                $promotionModel->setIdCas($casaNombre);
    
    
    
                if($promotionModel->save()){
                    $this->redirect('admin_report',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
                }else{
                    $this->redirect('admin_report',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
                }
    
    
    
            }else{
                // error, cargar vista con errores
                $this->redirect('admin_report',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
            }
        }

        //Obtener una promocion y mandarlo en formato JSON
        function getPromo(){
        
            error_log("ADMIN_REPORT: GETPROMO");
            
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

        //Actualiza una promocion y manda respuesta en JSON
        function updatePromocion(){
        
            error_log("ADMIN_REPORT: UPDATEPROMOCION");
           
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
                            echo json_encode('ok', JSON_UNESCAPED_UNICODE);
                            
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
    
        //Elimina una promocion y manda respuesta en JSON
        function deletePromocion(){
            error_log("ADMIN_REPORT: DELETEPROMOCION");
            
            if(!empty($_POST)){
                if($_POST['action'] == 'delPromocion'){
                    if(!empty($_POST['idPromocion']) ){
                        $id                = $_POST['idPromocion'];
                        $promotionModel     = new PromotionModel();
    
                        if($promotionModel->delete($id)){
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
    
    
        
    }
?>