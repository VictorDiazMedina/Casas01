<?php

class Anfitrion extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Anfitrion::constructor() ");
    }

    //Mostrar Vista
     function render(){
        error_log("Anfitrion::RENDER() ");

        $this->view->render('anfitrion/index', [
            'user'                => $this->user
        ]);
    }
    



}
?>