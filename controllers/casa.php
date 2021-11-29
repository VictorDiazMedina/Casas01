<?php

require_once 'models/casamodel.php';
class Casa extends SessionController{
    private $user;

    //traemos informacion de la clase corresp. Extends
    function __construct(){
        parent::__construct(); //Construct del SessionControl
        $this->user = $this->getUserSessionData();//funcion de SessionControl
    }

    function render(){
        $this->view->render('casa/index',[
            'user' => $this->user
        ]);
    }

    function nuevaCasa(){
        if(!$this->existPOST(['name', 'direction', 'id_anf'])){
            $this->redirect('anfitrion', []);//ERROR
            return;
        }

        if($this->user == NULL){
            $this->redirect('anfitrion',[]);//ERROR
            return;
        }

        $casa = new CasaModel();
        $casa->setName($this->getPost('name'));
        $casa->setDirection($this->getPost('direction'));
        $casa->setId_Anf($this->user->getId());

        $casa->save();
        $this->redirect('anfitrion',[]); //SUCCESS
    }

    function create(){
        $this->view->render('casa/create', [
            'user' => $this->user
        ]);
    }

    function getCasa_Anf(){
        $joinModel = new JoinCasaModel();
        $casas = $joinModel->getCasa_Anf($this->user->getId());
        
        $res = [];
        foreach($casas as $cas){
            array_push($res, $cas->getCasa_Anf());
        }
        $res = array_values(array_unique($res));

        return $res;
    }

    //MODO ADMIN - CORREGIR
    function delete($params){
        if($params == NULL){
            $this->redirect('casa',[]); //ERROR
        }
        $id = $params[0];
        $res = $this->model->delete($id);

        if($res){
            $this->redirect('casa',[]); //SUCCESS
        }else{
            $this->redirect('casa',[]); //ERROR 
        }
    }


}
?>