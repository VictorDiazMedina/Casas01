<?php

class ClauseModel extends Model implements IModel{

    private $id;
    private $clauIcon;
    private $clauTipo;
    private $clauDescrip;
    private $idCas;


    function __construct(){
        parent::__construct();
        $this->clauIcon = '';
        $this->clauTipo = '';
        $this->clauDescrip = '';
        $this->idCas = '';
    }


    //Funciones 
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Clausula(clau_Icon, clau_Tipo, clau_Descripcion, idCasa) VALUES(:clauIcon, :clauTipo, :clauDescrip, :idCas)');
            $query->execute([
                'clauIcon'  => $this->clauIcon,
                'clauTipo'  => $this->clauTipo,
                'clauDescrip'  => $this->clauDescrip,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('ClauseMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }


    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Clausula');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ClauseModel();

                $item->setId($p['idClausula']);
                $item->setClauIcon($p['clau_Icon']);
                $item->setClauTipo($p['clau_Tipo']);
                $item->setClauDescrip($p['clau_Descripcion']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('ClauseMODEL::getAll-> PDOExecption '.$e);
        }
    }


    public function get($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Clausula WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ClauseModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('ClauseMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getClause($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Clausula WHERE idClausula = :id');
            $query->execute(['id'=> $id]);

           
                $item = $query->fetch(PDO::FETCH_ASSOC);

            return $item;

        }catch(PDOException $e){
            error_log('ClauseMODEL::GetId-> PDOExecption '.$e);
        }
    }


    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Clausula WHERE idClausula = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('ClauseMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }


    public function update(){
        try{
            $query = $this->prepare('UPDATE Clausula SET clau_Icon = :clauIcon, clau_Tipo = :clauTipo, clau_Descripcion = :clauDescrip WHERE idClausula = :id');
            $query->execute([
                'id' => $this->id, 
                'clauIcon'  => $this->clauIcon,
                'clauTipo'  => $this->clauTipo,
                'clauDescrip'  => $this->clauDescrip

            ]);

            return true;
        }catch(PDOException $e){
            error_log('ClauseMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }


 


    public function from($array){

        $this->id = $array['idClausula'];
        $this->clauIcon= $array['clau_Icon'];
        $this->clauTipo= $array['clau_Tipo'];
        $this->clauDescrip= $array['clau_Descripcion'];
        $this->idCas = $array['idCasa'];

    }

    public function toArray(){
        $array = [];      
        $array['idClausula'] = $this->id;
        $array['clau_Icon'] = $this->clauIcon;
        $array['clau_Tipo'] = $this->clauTipo;
        $array['clau_Descripcion'] = $this->clauDescrip;
        $array['idCasa'] = $this->idCas;
        return $array;
    }






    public function setId($id){$this->id=$id;}
    public function setClauIcon($clauIcon){$this->clauIcon=$clauIcon;}
    public function setClauTipo($clauTipo){$this->clauTipo=$clauTipo;}
    public function setClauDescrip($clauDescrip){$this->clauDescrip=$clauDescrip;}
    public function setIdCas($idCas){$this->idCas=$idCas;}
    


    
    public function getIdCas(){return $this->idCas;}
    public function getClauDescrip(){return $this->clauDescrip;}
    public function getClauTipo(){return $this->clauTipo;}
    public function getClauIcon(){return $this->clauIcon;}
    public function getId(){return $this->id;}
    

}
?>