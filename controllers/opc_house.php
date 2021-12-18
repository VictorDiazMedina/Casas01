<?php

require_once 'models/usermodel.php';
require_once 'models/housemodel.php';
class Opc_house extends SessionController{

    
    private $user;
    private $house;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        $this->house = $this->getHouseSessionData();
        
        error_log("OPC_HOUSE:: construct() " . $this->user->getUserWhats());
        
        
    }


    //Muestra la VIsta, enviando datos del usuario anfitrion y su casa correspondiente
     function render(){
        error_log("OPC_HOUSE:: render()");

        $this->view->render('anfitrion/opc_house', [
            'user'                => $this->user,
            'house'               => $this->house

        ]);
    }
    
    //Funcion de GEOPLUGIN
    function fetch($host) {

		if ( function_exists('curl_init') ) {
						
			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
			$response = curl_exec($ch);
			curl_close ($ch);
			
		} else if ( ini_get('allow_url_fopen') ) {
			
			//fall back to fopen()
			$response = file_get_contents($host, 'r');
			
		} else {

			trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;
		
		}
		
		return $response;
	}
    
    //Funcion de GEOPLUGIN
    function nearby($radius=10, $limit=1, $latitude, $longitude) {

		if ( !is_numeric($latitude) || !is_numeric($longitude) ) {
			trigger_error ('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
			return array( array() );
		}
		
		$host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $latitude . "&long=" . $longitude . "&radius={$radius}";
		
		if ( is_numeric($limit) )
			$host .= "&limit={$limit}";
			
		return unserialize( $this->fetch($host) );

	}
    
    //Actualiza informacion de una Casa
    function updateHouse(){
        if($this->existPOST(['casaNombre', 'casaRenta', 'casaDeposito', 'casaLati', 'casaLong'])){
            
            $casaNombre = $this->getPost('casaNombre');
            $casaRenta = $this->getPost('casaRenta');
            $casaDeposito = $this->getPost('casaDeposito');
            $casaLati   = $this->getPost('casaLati');
            $casaLong   = $this->getPost('casaLong');
            $region = "";
            error_log("Anfitrion::updateHouse() " . $casaNombre );
            //validate data

            $this->house->setCasaNombre($casaNombre);
            $this->house->setCasaRenta($casaRenta);
            $this->house->setCasaDeposito($casaDeposito);
            $this->house->setCasaLati($casaLati);
            $this->house->setCasaLong($casaLong);


                        
            $nearby = $this->nearby($radius=10, $limit=1, $casaLati, $casaLong);

            if ( isset($nearby[0]['geoplugin_place']) ) {

                foreach ( $nearby as $key => $array ) {
                    $region = $array['geoplugin_region'];
                }
            }


            $this->house->setCasaRegion($region);

            if($this->house->update()){
                $this->redirect('opc_house',['success'=> SuccessMessages::SUCCESS_REGISTRO_SUCCESS]);
            }else{
                $this->redirect('opc_house',['error'=> ErrorMessages::ERROR_REGISTRO_ERROR]);
            }



        }else{
            // error, cargar vista con errores
            $this->redirect('opc_house',['error'=> ErrorMessages::ERROR_REGISTRO_EXISTE]);
        }
    }

    //Guarda una fotografia en Galeria
    function saveGallery(){
                
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
            error_log("OPC_HOUSE::updateImg(): " .  $photoname[0]);
            error_log("OPC_HOUSE::updateImg(): " .  $hash);
            
            
            $urlPhoto = $folderPath . $hash;
           
           
                //YA EXISTE UNA FOTO
                
            unlink("assets/image/anfitriones/". $this->house->getId(). "/" .  $this->house->getCasaLogo()); 
                
            $this->house->updateLogo($hash,$this->house->getId());  
                
            file_put_contents($urlPhoto, $image_base64);
            echo json_encode(["image uploaded successfully."]);   
            
    }
 
    //Actualiza la fotografia de perfil del usuario anfitrion
    function updateImg(){
        if(!isset($_FILES['photo'])){
            $this->redirect('opc_house', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            return;
        }
        $photo = $_FILES['photo'];

        $target_dir = "assets/image/anfitriones/";
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        error_log("Anfitrion::updateImg(): " . $filename);
        error_log("Anfitrion::updateImg(): " . $hash);
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            
            $uploadOk = 1;
        } else {
            
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            // Si todo está bien, intenta cargar el archivo
            $this->redirect('opc_house', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO_FORMAT]);
            
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $this->user->updatePhoto($hash, $this->user->getId());
                unlink("assets/image/anfitriones/" . $this->user->getUserPerfil());
                $this->redirect('opc_house', ['success' => SuccessMessages::SUCCESS_USER_UPDATEPHOTO]);
            } else {
                $this->redirect('opc_house', ['error' => ErrorMessages::ERROR_USER_UPDATEPHOTO]);
            }
        }

    }


}
?>