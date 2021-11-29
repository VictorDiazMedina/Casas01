<?php

require_once 'models/joincasamodel.php';
class Anfitrion extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Anfitrion::constructor() ");
    }

     function render(){
        error_log("Anfitrion::RENDER() ");

        $this->view->render('anfitrion/index', [
            'user'                => $this->user
        ]);
    }
    


    
    public function getCasa(){
            /*$res = [];
            $casaModel = new CasaModel();

            $casas = $casaModel->getAll();

            foreach($casas as $casa){
                $casaArray = [];

            }
            return $casa-> get($);*/
    }


}
?>