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
        
        error_log("Anfitrion::constructor() " . $this->user->getUserWhats());
        
        error_log("Anfitrion::constructor() " .  $this->house->getIdUsuario());
        
    }


     function render(){
        error_log("Anfitrion::RENDER() ");
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


    function getDataGalleryJSON(){
        header('Content-Type: application/json');
        $res = [];
        $photoModel = new PhotoModel();
        $photos = $photoModel->getGallery("galeria",$this->house->getId());

        foreach ($photos as $photo) {
            array_push($res, $photo->toArray());
        }
        
        error_log("AAAAAAAAAAAAAAAAAAAA".$this->house->getId());
        
        echo json_encode($res);

    }

    function saveGallery(){
    //print_r($_POST); exit;
        $imageTyp = $_POST['imageType'];
            
        $folderPath = './assets/image/anfitriones/'.$this->house->getId().'/';
        error_log("URL: ".$folderPath);
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
        error_log("OPC_PAGE::updateImg(): " .  $photoname[0]);
        error_log("OPC_PAGE::updateImg(): " .  $hash);
        error_log("BBBBBBBBBBBBBBBBB " .  $imageTyp);
        
        $photoModel = new PhotoModel();
        $photoModel->setImgTipo($imageTyp);
        $photoModel->setImgUrl($hash);
        $photoModel->setIdCas($this->house->getId());

        $urlPhoto = $folderPath . $hash;
       
        if($photoModel->exists($imageTyp, $this->house->getId())){
            //YA EXISTE UNA FOTO
            
            $imgModel = new PhotoModel();
            $items = $imgModel->getPhoto($imageTyp, $this->house->getId());
            error_log("items: ".$items['idFotografia']);
            unlink("assets/image/anfitriones/". $this->house->getId(). "/" . $items['img_Url']); 
            
            $photoModel->setId($items['idFotografia']);
            $photoModel->update();  
            
            file_put_contents($urlPhoto, $image_base64);
            echo json_encode(["image uploaded successfully."]);  
            
        }else if($photoModel->save()){
            //NO EXISTE FOTO
            file_put_contents($urlPhoto, $image_base64);
            echo json_encode(["image uploaded successfully."]);
        }
        
    }

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
        error_log("Anfitrion::updateImg(): " .  $filename);
        error_log("Anfitrion::updateImg(): " .  $hash);
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT]);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $photoModel = new PhotoModel();
                $photoModel->setImgTipo("galeria");
                $photoModel->setImgUrl($hash);
                $photoModel->setIdCas($this->house->getId());

                $photoModel->uploadImg();
                
            echo json_encode(["image uploaded successfully."]);
            } else {
                $this->redirect('opc_settings', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            }
            
        }
    }


    function updateHouseDescrip(){
        if($this->existPOST(['casaDescrip'])){
            
            $casaDescrip = $this->getPost('casaDescrip');
            
            //validate data
            

            $this->house->setCasaDescrip($casaDescrip);
            
            if($this->house->updateDescrip()){
                //$this->view->render('login/index');
                $this->redirect('opc_page',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('opc_page',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
            }
            

            
        }else{
            // error, cargar vista con errores
            //$this->errorAtSignup('Ingresa nombre de usuario y casaLati');
            $this->redirect('opc_house',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
        }
    }


    function getDataServiceJSON(){
        header('Content-Type: application/json');
        $res = [];
        $serviceModel     = new ServiceModel();
        $services = $serviceModel->get($this->house->getId());

        foreach ($services as $service) {
            array_push($res, $service->toArray());
        }
        
        error_log("AAAAAAAAAAAAAAAAAAAA".$this->house->getId());
        
        echo json_encode($res);

    }

    function getService(){
        
        error_log("OPC_PAGE: GETSERVICE");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            //extraer datos
            if($_POST['action'] == 'infoServicio'){
                
                $id = $_POST['servicio'];

                
                error_log("id: ". $id);
                $serviceModel     = new ServiceModel();
                $service = $serviceModel->getService($id);
                
                
                echo json_encode($service, JSON_UNESCAPED_UNICODE);
                error_log("CONSULTAR PRODUCTO ");
                exit;
            }
            echo 'error';
        }
        exit;
    }

    function addService(){
        
        error_log("OPC_PAGE: ADDSERVICE");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            if($_POST['action'] == 'addService'){
                if(!empty($_POST['servDescrip'])){

                    error_log("FECHA CORRECTA");
                    $servIcon         = $_POST['servIcon'];
                    $servCantidad     = $_POST['servCantidad'];
                    $servDescrip      = $_POST['servDescrip'];
                    $idCasa           = $_POST['idCasa'];
                            
                    $serviceModel     = new ServiceModel();


                    $servIconClean = $this->strClean($servIcon);
                    error_log('LIMPIO'.$servIconClean);
                       
                       
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


    function updateService(){
        
        error_log("OPC_PAGE: UPDATESERVICE");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            if($_POST['action'] == 'updateService'){
                if(!empty($_POST['servDescrip'])){

                    $servIconClean   = $_POST['servIcon'];
                    $servCantidad   = $_POST['servCantidad'];
                    $servDescrip   = $_POST['servDescrip'];
                    $id            = $_POST['idServicio'];
                            
                    $serviceModel     = new ServiceModel();


                    $servIcon = $this->strClean($servIconClean);
                    error_log('LIMPIO'.$servIconClean);
                       
                       
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

    function deleteService(){
        error_log("OPC_PAGE: DELETESERVICE");
        //print_r($_POST); exit;
        if(!empty($_POST)){
            if($_POST['action'] == 'delservice'){
                if(!empty($_POST['idservicio']) ){
                    $id                = $_POST['idservicio'];
                    $ServiceModel     = new ServiceModel();

                    if($ServiceModel->delete($id)){
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



    //CLAUSULA 
    
function getDataClauseJSON(){
    header('Content-Type: application/json');
    $res = [];
    $ClauseModel     = new ClauseModel();
    $Clauses = $ClauseModel->get($this->house->getId());

    foreach ($Clauses as $Clause) {
        array_push($res, $Clause->toArray());
    }
    
    error_log("AAAAAAAAAAAAAAAAAAAA".$this->house->getId());
    
    echo json_encode($res);

}

function getClause(){
    
    error_log("OPC_PAGE: GETClause");
    //print_r($_POST); exit;
    if(!empty($_POST)){
        //extraer datos
        if($_POST['action'] == 'infoClausula'){
            
            $id = $_POST['clausula'];

            
            error_log("id: ". $id);
            $ClauseModel     = new ClauseModel();
            $Clause = $ClauseModel->getClause($id);
            
            
            echo json_encode($Clause, JSON_UNESCAPED_UNICODE);
            error_log("CONSULTAR PRODUCTO ");
            exit;
        }
        echo 'error';
    }
    exit;
}

function addClause(){
    
    error_log("OPC_PAGE: ADDClause");
    //print_r($_POST); exit;
    if(!empty($_POST)){
        if($_POST['action'] == 'addClause'){
            if(!empty($_POST['clauDescrip'])){

                error_log("FECHA CORRECTA");
                $clauIconClean   = $_POST['clauIcon'];
                $clauTipo   = $_POST['clauTipo'];
                $clauDescrip   = $_POST['clauDescrip'];
                $idCasa            = $_POST['idCasa'];
                        
                $ClauseModel     = new ClauseModel();


                $clauIcon = $this->strClean($clauIconClean);
                error_log('LIMPIO'.$clauIcon);
                   
                   
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


function updateClause(){
    
    error_log("OPC_PAGE: UPDATEClause");
    //print_r($_POST); exit;
    if(!empty($_POST)){
        if($_POST['action'] == 'updateClause'){
            if(!empty($_POST['clauDescrip'])){

                $clauIconClean   = $_POST['clauIcon'];
                $clauTipo   = $_POST['clauTipo'];
                $clauDescrip   = $_POST['clauDescrip'];
                $id            = $_POST['idClausula'];
                        
                $ClauseModel     = new ClauseModel();


                $clauIcon = $this->strClean($clauIconClean);
                error_log('LIMPIO'.$clauIconClean);
                   
                   
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

function deleteClause(){
    error_log("OPC_PAGE: DELETEClause");
    //print_r($_POST); exit;
    if(!empty($_POST)){
        if($_POST['action'] == 'delClause'){
            if(!empty($_POST['idClausula']) ){
                $id                = $_POST['idClausula'];
                $ClauseModel     = new ClauseModel();

                if($ClauseModel->delete($id)){
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

    function strClean($strcadena){
        $string = str_ireplace("<i class=","",$strcadena);
        $string = str_ireplace("></i>","",$string);
        $string = str_ireplace('"',"",$string);
        return $string;
    }
    
    
    
}
?>