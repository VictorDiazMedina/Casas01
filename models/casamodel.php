<?php

class CasaModel extends Model implements IModel{

    private $id;
    private $name;
    private $direction;
    private $id_anf;



    public function setId($id){$this->id=$id;}
    public function setName($name){$this->name=$name;}
    public function setDirection($direction){$this->direction=$direction;}
    public function setId_Anf($id_anf){$this->id_anf=$id_anf;}
   

    public function getId(){return $this->id;}    
    public function getName(){return $this->name;}
    public function getDirection(){return $this->$direction;}
    public function getId_anf(){return $this->id_anf;}   

    public function __construct(){
        parent::__construct();
    }


    public function save(){
        try{
            $query = $this->prepare('INSERT INTO casa (casa_Nombre, casa_Direccion, idanfitrion) VALUE(:name, :direction, :id_anf)');
            $query->execute([
                'name' => $this->name,
                'direction'=> $this->$direction,
                'id_anf' => $this->$id_anf
            ]);

            if($query->rowCount()) return true;
            return false;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM casa');
           
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CasaModel();
                $item->from($p);

                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return false;
        }
    }

    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM casa WHERE idcasa = :id');
            $query->execute([
                'id' => $id
            ]);

            $casa = $query->fetch(PDO::FECTH_ASSOC); //transformacion de arreglo
            $this->from($casa);

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM casa WHERE idcasa = :id');
            $query->execute([
                'id' => $id
            ]);

            return true;
        }catch(PDOException $e){
            return false;
        }  
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE casa SET casa_Nombre = :name, casa_Direccion = :direction, idanfitrion = :id_anf WHERE idcasa = :id');
            $query->execute([
                'name' => $this->name,
                'direction'=> $this->$direction,
                'id_anf' => $this->$id_anf,
                'id' => $this->$id
            ]);

            if($query->rowCount()) return true;
            return false;
        }catch(PDOException $e){
            return false;
        }
    }


    public function from($array){
        $this->id = $array['idcasa'];
        $this->name = $array['casa_Nombre'];        
        $this->direction = $array['casa_Direccion'];        
        $this->id_anf = $array['idanfitrion'];
    }
}

?>