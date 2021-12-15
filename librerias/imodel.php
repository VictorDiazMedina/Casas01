<?php

//Estructura de metodos base
interface IModel{
    public function save();
    public function getAll();
    public function get($id);
    public function delete($id);
    public function update();
    public function from($array);
}
?>