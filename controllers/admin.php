<?php

class Admin extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->user = $this->getUserSessionData();
        error_log("Admin::constructor() ");
    }

     function render(){
        error_log("Admin::RENDER() ");

        $this->view->render('admin/index', [
            'user'                => $this->user
        ]);
    }

  
}
?>