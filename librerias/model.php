<?php

include_once 'librerias/imodel.php';
class Model{
    //Implementacion del Modelo a la Base de Datos
    function __construct(){
        $this->db = new Database();//Nueva instancia de BaseDeDatos
    }

    //Consultas
    function query($query){
        //Conecta a la base de datos "connect()", ejecutando la Consulta
        return $this->db->connect()->query($query);
    }

    //Inyeccion de datos 
    function prepare($query){
        return $this->db->connect()->prepare($query);
    }
}
?>