<?php

require_once 'models/usermodel.php';
require_once 'models/housemodel.php';
require_once 'models/servicemodel.php';
require_once 'models/clausemodel.php';
require_once 'models/photomodel.php';
class Opc_page extends SessionController{

    
    private $user;
    private $house;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        $this->house = $this->getHouseSessionData();
        
        error_log("OPC_PAGE::construct() " . $this->user->getUserWhats());
        
    }

    //Carga la Vista con datos de Usuario, Casa y Fotografias
    function render(){
        error_log("OPC_PAGE:: render()");
        $photoModel = new PhotoModel();
        $imgH       = $photoModel->getUrlPhoto("header", $this->house->getId());        
        $imgR1      = $photoModel->getUrlPhoto("right1", $this->house->getId());        
        $imgR2      = $photoModel->getUrlPhoto("right2", $this->house->getId());
        
        $this->view->render('anfitrion/opc_page', [
            'user'                => $this->user,
            'house'               => $this->house,
            'imgH'                => $imgH,
            'imgR1'               => $imgR1,
            'imgR2'               => $imgR2

        ]);
    }

    //Obtener fotografias de tipo Galeria de una casa en especifica. Enviandolo en formato JSON
    function getDataGalleryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $photoModel = new PhotoModel();
        $photos = $photoModel->getGallery("galeria",$this->house->getId());

        foreach ($photos as $photo) {
            array_push($res, $photo->toArray());
        }
        
        echo json_encode($res);

    }

    //Guarda una fotografia para una casa en especifica
    function saveGallery(){
        $imageTyp = $_POST['imageType'];
            
        $folderPath = './assets/image/anfitriones/'.$this->house->getId().'/';
    
        $image_parts = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';
        
        $photo = (explode("/",$file));

        $photoname = (explode(".",$photo[5]));

        $hash = md5(Date('Ymdgi') . $photoname[0]) . '.' . $photoname[1];
        $target_file = $folderPath . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        
        $photoModel = new PhotoModel();
        $photoModel->setImgTipo($imageTyp);
        $photoModel->setImgUrl($hash);
        $photoModel->setIdCas($this->house->getId());

        $urlPhoto = $folderPath . $hash;
       
        if($photoModel->exists($imageTyp, $this->house->getId())){
            //YA EXISTE UNA FOTO
            
            $imgModel = new PhotoModel();
            $items = $imgModel->getPhoto($imageTyp, $this->house->getId());
           
            unlink("assets/image/anfitriones/". $this->house->getId(). "/" . $items['img_Url']); 
            
            $photoModel->setId($items['idFotografia']);
            $photoModel->update();  
            
            file_put_contents($urlPhoto, $image_base64);
            echo json_encode(["Fotografia se subio con Éxito."]);  
            
        }else if($photoModel->save()){
            //NO EXISTE FOTO
            file_put_contents($urlPhoto, $image_base64);
            echo json_encode(["Fotografia se subio con Éxito."]);
        }
        
    }

    //Guarda una fotografia de tipo Galeria
    function uploadImg(){
        if(!isset($_FILES['file'])){
            $this->redirect('opc_page', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            return;
        }
        $photo = $_FILES['file'];

        $target_dir = "assets/image/anfitriones/".$this->house->getId()."/";
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //Es un Imagen
            $uploadOk = 1;
        } else {
            //No es una Imagen
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT]);
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $photoModel = new PhotoModel();
                $photoModel->setImgTipo("galeria");
                $photoModel->setImgUrl($hash);
                $photoModel->setIdCas($this->house->getId());

                $photoModel->uploadImg();
                
            echo json_encode(["Fotografia se subio con Éxito."]);
            } else {
                $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            }
            
        }
    }

    //Actualiza descripcion de la Casa
    function updateHouseDescrip(){
        if($this->existPOST(['casaDescrip'])){
            
            $casaDescrip = $this->getPost('casaDescrip');
            
            //validate data
            

            $this->house->setCasaDescrip($casaDescrip);
            
            if($this->house->updateDescrip()){
                $this->redirect('opc_page',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
            }else{
                
                $this->redirect('opc_page',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
            }
            

            
        }else{
            // error, cargar vista con errores
            
            $this->redirect('opc_house',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
        }
    }


    //FUNCIONES DE SERVICIO

    //Obtiene todos los Servicios de una casa en Especifica, enviandolo en fomato JSON
    function getDataServiceJSON(){
        header('Content-Type: application/json');
        $res = [];
        $serviceModel     = new ServiceModel();
        $services = $serviceModel->get($this->house->getId());

        foreach ($services as $service) {
            array_push($res, $service->toArray());
        }
        
       
        
        echo json_encode($res);

    }

    //Obtiene un servicio en Especifico
    function getService(){
        
        error_log("OPC_PAGE:: getService()");
       
        if(!empty($_POST)){
            //extraer datos
            if($_POST['action'] == 'infoServicio'){
                
                $id = $_POST['servicio'];

                
                $serviceModel     = new ServiceModel();
                $service = $serviceModel->getService($id);
                
                
                echo json_encode($service, JSON_UNESCAPED_UNICODE);
                
                exit;
            }
            echo 'error';
        }
        exit;
    }

    //Guarda un nuevo servicio para una casa
    function addService(){
        
        error_log("OPC_PAGE:: addService()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'addService'){
                if(!empty($_POST['servDescrip'])){

                    $servIcon         = $_POST['servIcon'];
                    $servCantidad     = $_POST['servCantidad'];
                    $servDescrip      = $_POST['servDescrip'];
                    $idCasa           = $_POST['idCasa'];
                            
                    $serviceModel     = new ServiceModel();


                    $servIconClean = $this->strClean($servIcon);
                      
                       
                    $serviceModel ->setServIcon($servIconClean);
                    $serviceModel ->setServCantidad($servCantidad);
                    $serviceModel ->setServDescrip($servDescrip);                       
                    $serviceModel ->setIdCas($idCasa);

                    if($serviceModel->save()){
                        echo json_encode("ok", JSON_UNESCAPED_UNICODE);
                        exit;
                    }else{
                        echo json_encode("error", JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }else{
                    echo json_encode("error", JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
            exit;
        }
        exit;
    }

    //Actualiza un servicio
    function updateService(){
        
        error_log("OPC_PAGE:: updateService()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'updateService'){
                if(!empty($_POST['servDescrip'])){

                    $servIconClean  = $_POST['servIcon'];
                    $servCantidad   = $_POST['servCantidad'];
                    $servDescrip    = $_POST['servDescrip'];
                    $id             = $_POST['idServicio'];
                            
                    $serviceModel     = new ServiceModel();


                    $servIcon = $this->strClean($servIconClean);
                     
                       
                    $serviceModel ->setServIcon($servIcon);
                    $serviceModel ->setServCantidad($servCantidad);
                    $serviceModel ->setServDescrip($servDescrip);
                    $serviceModel ->setId($id);

                    if($serviceModel->update()){
                        $serviceModelUp     = new ServiceModel();
                        $service = $serviceModelUp->getService($id);
                        echo json_encode($service, JSON_UNESCAPED_UNICODE);
                        exit;
                    }else{
                        echo json_encode("error", JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }else{
                    echo json_encode("error", JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
        }
        exit;
    }

    //Elimina un servicio
    function deleteService(){
        error_log("OPC_PAGE:: deleteService()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'delservice'){
                if(!empty($_POST['idservicio']) ){
                    $id               = $_POST['idservicio'];
                    $ServiceModel     = new ServiceModel();

                    if($ServiceModel->delete($id)){
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



    //FUNCIONES DE CLAUSULAS
    
    //Obtiene todos las Clausulas de una casa en Especifica, enviandolo en fomato JSON
    function getDataClauseJSON(){
        header('Content-Type: application/json');
        $res = [];
        $ClauseModel     = new ClauseModel();
        $Clauses = $ClauseModel->get($this->house->getId());

        foreach ($Clauses as $Clause) {
            array_push($res, $Clause->toArray());
        }
        
        
        echo json_encode($res);

    }

    //Obtiene una clausula en Especifico
    function getClause(){
        
        error_log("OPC_PAGE: getClause()");
        
        if(!empty($_POST)){
            //extraer datos
            if($_POST['action'] == 'infoClausula'){
                
                $id = $_POST['clausula'];

                
                $ClauseModel     = new ClauseModel();
                $Clause = $ClauseModel->getClause($id);
                
                
                echo json_encode($Clause, JSON_UNESCAPED_UNICODE);
                
                exit;
            }
            echo 'error';
        }
        exit;
    }

    //Guarda una nueva clausula para una casa
    function addClause(){
        
        error_log("OPC_PAGE: addClause()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'addClause'){
                if(!empty($_POST['clauDescrip'])){

                    
                    $clauIconClean   = $_POST['clauIcon'];
                    $clauTipo   = $_POST['clauTipo'];
                    $clauDescrip   = $_POST['clauDescrip'];
                    $idCasa            = $_POST['idCasa'];
                            
                    $ClauseModel     = new ClauseModel();

                    $clauIcon = $this->strClean($clauIconClean);
                     
                    $ClauseModel ->setClauIcon($clauIcon);
                    $ClauseModel ->setClauTipo($clauTipo);
                    $ClauseModel ->setClauDescrip($clauDescrip);                       
                    $ClauseModel ->setIdCas($idCasa);

                    if($ClauseModel->save()){
                        echo json_encode("ok", JSON_UNESCAPED_UNICODE);
                        exit;
                    }else{
                        echo json_encode("error", JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }else{
                    echo json_encode("error", JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
            exit;
        }
        exit;
    }

    //Actualiza una clausula
    function updateClause(){
        
        error_log("OPC_PAGE:: updateClause()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'updateClause'){
                if(!empty($_POST['clauDescrip'])){

                    $clauIconClean  = $_POST['clauIcon'];
                    $clauTipo       = $_POST['clauTipo'];
                    $clauDescrip    = $_POST['clauDescrip'];
                    $id             = $_POST['idClausula'];
                            
                    $ClauseModel     = new ClauseModel();


                    $clauIcon = $this->strClean($clauIconClean);
                    
                    
                    $ClauseModel ->setClauIcon($clauIcon);
                    $ClauseModel ->setClauTipo($clauTipo);
                    $ClauseModel ->setClauDescrip($clauDescrip);
                    $ClauseModel ->setId($id);

                    if($ClauseModel->update()){
                        $ClauseModelUp     = new ClauseModel();
                        $Clause = $ClauseModelUp->getClause($id);
                        echo json_encode($Clause, JSON_UNESCAPED_UNICODE);
                        exit;
                    }else{
                        echo json_encode("error", JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }else{
                    echo json_encode("error", JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
        }
        exit;
    }

    //Elimina una clausula
    function deleteClause(){
        error_log("OPC_PAGE:: deleteClause()");
        
        if(!empty($_POST)){
            if($_POST['action'] == 'delClause'){
                if(!empty($_POST['idClausula']) ){
                    $id              = $_POST['idClausula'];
                    $ClauseModel     = new ClauseModel();

                    if($ClauseModel->delete($id)){
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

    //Limpia la cadena para insertar un icono. Actualmente no esta en Uso, se cambio por EMOJIS
    function strClean($strcadena){
        $string = str_ireplace("<i class=","",$strcadena);
        $string = str_ireplace("></i>","",$string);
        $string = str_ireplace('"',"",$string);
        return $string;
    }
    
    
    
}
?>