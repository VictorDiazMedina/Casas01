<?php

class ServiceModel extends Model implements IModel{

    private $id;
    private $servIcon;
    private $servCantidad;
    private $servDescrip;
    private $idCas;


    function __construct(){
        parent::__construct();
        $this->servIcon = '';
        $this->servCantidad = '';
        $this->servDescrip = '';
        $this->idCas = '';
    }


    //Funciones 
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Servicio(serv_Icon, serv_Cantidad, serv_Descripcion, idCasa) VALUES(:servIcon, :servCantidad, :servDescrip, :idCas)');
            $query->execute([
                'servIcon'  => $this->servIcon,
                'servCantidad'  => $this->servCantidad,
                'servDescrip'  => $this->servDescrip,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('SERVICEMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }


    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Servicio');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ServiceModel();

                $item->setId($p['idServicio']);
                $item->setServIcon($p['serv_Icon']);
                $item->setServCantidad($p['serv_Cantidad']);
                $item->setServDescrip($p['serv_Descripcion']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('SERVICEMODEL::getAll-> PDOExecption '.$e);
        }
    }


    public function get($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Servicio WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ServiceModel();
                $item->setId($p['idServicio']);
                $item->setServIcon($p['serv_Icon']);
                if($p['serv_Cantidad'] == 0){
                    $item->setServCantidad("");
                }else{
                    $item->setServCantidad($p['serv_Cantidad']);
                }
                
                $item->setServDescrip($p['serv_Descripcion']);
                $item->setIdCas($p['idCasa']);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('SERVICEMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getService($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Servicio WHERE idServicio = :id');
            $query->execute(['id'=> $id]);

           
                $item = $query->fetch(PDO::FETCH_ASSOC);

            return $item;

        }catch(PDOException $e){
            error_log('SERVICEMODEL::GetId-> PDOExecption '.$e);
        }
    }


    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Servicio WHERE idServicio = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('SERVICEMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }


    public function update(){
        try{
            $query = $this->prepare('UPDATE Servicio SET serv_Icon = :servIcon, serv_Cantidad = :servCantidad, serv_Descripcion = :servDescrip WHERE idServicio = :id');
            $query->execute([
                'id' => $this->id, 
                'servIcon'  => $this->servIcon,
                'servCantidad'  => $this->servCantidad,
                'servDescrip'  => $this->servDescrip

            ]);

            return true;
        }catch(PDOException $e){
            error_log('SERVICEMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }


 


    public function from($array){

        $this->id = $array['idServicio'];
        $this->servIcon= $array['serv_Icon'];
        $this->servCantidad= $array['serv_Cantidad'];
        $this->servDescrip= $array['serv_Descripcion'];
        $this->idCas = $array['idCasa'];

    }

    public function toArray(){
        $array = [];      
        $array['idServicio'] = $this->id;
        $array['serv_Icon'] = $this->servIcon;
        $array['serv_Cantidad'] = $this->servCantidad;
        $array['serv_Descripcion'] = $this->servDescrip;
        $array['idCasa'] = $this->idCas;
        return $array;
    }






    public function setId($id){$this->id=$id;}
    public function setServIcon($servIcon){$this->servIcon=$servIcon;}
    public function setServCantidad($servCantidad){$this->servCantidad=$servCantidad;}
    public function setServDescrip($servDescrip){$this->servDescrip=$servDescrip;}
    public function setIdCas($idCas){$this->idCas=$idCas;}
    


    
    public function getIdCas(){return $this->idCas;}
    public function getServDescrip(){return $this->servDescrip;}
    public function getServCantidad(){return $this->servCantidad;}
    public function getServIcon(){return $this->servIcon;}
    public function getId(){return $this->id;}
    

}
?>