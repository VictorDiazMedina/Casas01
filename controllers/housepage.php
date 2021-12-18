<?php

require_once 'models/housemodel.php';
require_once 'models/photomodel.php';
require_once 'models/servicemodel.php';
require_once 'models/clausemodel.php';
require_once 'models/commentmodel.php';

    class Housepage extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('HOUSEPAGE::construct');
        }

        //Mostrar Vista
        function render(){
            error_log('HOUSEPAGE::render');
            
            
            $this->view->render('inicio/housepage',[
            ]);
        }
        
        //Obtener todos los comentarios de una casa
        function getDataCommentJSON(){
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                $res = [];
                $idCasa = $input['idCasa'];
                $commentModel     = new CommentModel();
                $comments = $commentModel->get($idCasa);
        
                foreach ($comments as $comment) {
                    array_push($res, $comment->toArray());
                }

                if(empty ( $res )){
                    echo json_encode('NULO');
                }else {
                    echo json_encode($res);
                }
                exit;
            }
            
            exit;
        }
        
        //Captura un nuevo comentario a una casa
        function addComment(){
        
            error_log("HOUSEPAGE: addComment()");
            
            if(!empty($_POST)){
                if($_POST['action'] == 'addComment'){
                    if(!empty($_POST['commentEmail'])){
    
                        error_log("FECHA CORRECTA");
                        $commentNomb         = $_POST['commentNomb'];
                        $commentEmail     = $_POST['commentEmail'];
                        $commentText      = $_POST['commentText'];
                        $idCasa           = $_POST['idCasa'];
                             
                       
                        if (filter_var($commentEmail, FILTER_VALIDATE_EMAIL)) {
                            
                            date_default_timezone_set('UTC');
                            date_default_timezone_set("America/Mexico_City");
                            setlocale(LC_TIME, 'spanish');
                            $commentFech = strtolower(strftime("%B del %Y"));
                            $commentModel     = new CommentModel();
 
                            
                            $commentModel ->setCommentFecha($commentFech); 
                            $commentModel ->setCommentNomb($commentNomb);
                            $commentModel ->setCommentEmail($commentEmail);
                            $commentModel ->setCommentText($commentText);                       
                            $commentModel ->setIdCas($idCasa);
        
                            if($commentModel->save()){
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
                        
                        
                    }else{
                        echo json_encode("error", JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }
                exit;
            }
            exit;
        }
        
        //Obtiene las fotografias de tipo Galeria de una casa
        function galleryHouse(){
            
            error_log("HOUSEPAGE: galleryHouse()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    
                    $res = [];
                    
                    $photoModel = new PhotoModel();

                    $photos = $photoModel->getGallery("galeria",$idCasa);
                    foreach ($photos as $photo) {
                        array_push($res, $photo->toArray());
                    }
                    
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo 'error';
            exit;

        } 
        
        //Obtiene todas las clausulas de una Casa
        function clauHouse(){
            
            error_log("HOUSEPAGE: clauHouse()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    
                    $res = [];
                    
                    $clauseModel = new ClauseModel();

                    $clauses = $clauseModel->get($idCasa);
                    foreach ($clauses as $clause) {
                        array_push($res, $clause->toArray());
                    }
                    
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo 'error';
            exit;

        } 

        //Obtiene  todos los servicios de una Casa
        function servHouse(){
            
            error_log("HOUSEPAGE: servHouse()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    
                    $res = [];
                    
                    $serviceModel = new ServiceModel();

                    $services = $serviceModel->get($idCasa);
                    foreach ($services as $service) {
                        array_push($res, $service->toArray());
                    }
                    
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo 'error';
            exit;

        }     

        //Obtener fotografias de una Casa
        function imgHouse(){
            
            error_log("HOUSEPAGE: imgHouse()");
            header("Content-type: application/json; charset=utf-8");
            $input = json_decode(file_get_contents("php://input"), true);

            if(!empty($input)){
                //extraer datos
                    $idCasa = $input['idCasa'];
    
                    
                    $res = [];
                    
                    $photoModel = new PhotoModel();

                    $photos = $photoModel->getImg($idCasa);
                    foreach ($photos as $photo) {
                        array_push($res, $photo->toArray());
                    }
                    
                    
                    echo json_encode($res);
                    exit;
               
            }
            echo 'error';
            exit;

        }
        
        //Obtener datos de una Casa
        function dataHouse(){
            
            error_log("HOUSEPAGE: dataHouse()");
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


        
    }
?>