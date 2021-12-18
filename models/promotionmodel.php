<?php

class PromotionModel extends Model implements IModel{

    private $id;
    private $promoCodigo;
    private $promoCantidad;
    private $idCas;


    function __construct(){
        parent::__construct();
        $this->promoCodigo = '';
        $this->promoCantidad = '';
        $this->idCas = '';
    }


    //Funciones de MODELO PROMOCIONES

    //Funcion para guardar
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Promocion(promo_Codigo, promo_Cantidad, idCasa) VALUES(:promoCodigo, :promoCantidad, :idCas)');
            $query->execute([
                'promoCodigo'  => $this->promoCodigo,
                'promoCantidad'  => $this->promoCantidad,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('PromotionModel::save-> PDOExecption '.$e);
            return false;
        }
    }

    //Obtener todas las promociones
    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT idPromocion, promo_Codigo, promo_Cantidad, casa_Nombre as idCasa FROM Promocion
            INNER JOIN Casa ON Promocion.idCasa = Casa.idCasa');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PromotionModel();

                $item->setId($p['idPromocion']);
                $item->setPromoCodigo($p['promo_Codigo']);
                $item->setPromoCantidad($p['promo_Cantidad']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('PromotionModel::getAll-> PDOExecption '.$e);
        }
    }

    //Obtener todas las promociones de una casa en especifica
    public function getPromoCasa($id){
       
        try{
            $query = $this->prepare('SELECT * FROM Promocion WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            $p = $query->fetch(PDO::FETCH_ASSOC);
                
            

            return $p['idPromocion'];

        }catch(PDOException $e){
            error_log('PromotionModel::GetId-> PDOExecption '.$e);
        }
    }

    //Obtener una promocion por su codigo y ID
    public function getPromoCanti($promoCodigo, $idPromocion){
       
        try{
            $query = $this->prepare('SELECT * FROM Promocion WHERE idPromocion = :idPromocion AND promo_Codigo = :promoCodigo');
            $query->execute(['promoCodigo' => $promoCodigo, 'idPromocion' => $idPromocion]);

            $p = $query->fetch(PDO::FETCH_ASSOC);
                
            

            return $p['promo_Cantidad'];

        }catch(PDOException $e){
            error_log('PromotionModel::GetId-> PDOExecption '.$e);
        }
    }

    //Obtener todas las promociones de una casa en especifica
    public function get($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Promocion WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PromotionModel();
                $item->setId($p['idPromocion']);
                $item->setPromoCodigo($p['promo_Codigo']);
                $item->setIdCas($p['idCasa']);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('PromotionModel::GetId-> PDOExecption '.$e);
        }
    }

    //Obtener un promocion especifica
    public function getPromo($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Promocion WHERE idPromocion = :id');
            $query->execute(['id'=> $id]);

           
                $item = $query->fetch(PDO::FETCH_ASSOC);

            return $item;

        }catch(PDOException $e){
            error_log('PROMOTIONMODEL::GetPromo-> PDOExecption '.$e);
        }
    }
    
    //Eliminar una promocion
    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Promocion WHERE idPromocion = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('PromotionModel::Delete-> PDOExecption '.$e);
            return false;
        }
    }

    //Actualizar una promocion
    public function update(){
        try{
            $query = $this->prepare('UPDATE Promocion SET promo_Codigo = :promoCodigo, promo_Cantidad = :promoCantidad WHERE idPromocion = :id');
            $query->execute([
                'id' => $this->id, 
                'promoCodigo'  => $this->promoCodigo,
                'promoCantidad'  => $this->promoCantidad

            ]);

            return true;
        }catch(PDOException $e){
            error_log('PromotionModel::Update-> PDOExecption '.$e);
            return false;
        }
    }

    //Verificar que exista una promocion por codifo y ID
    public function exists($promoCodigo, $idPromocion){
        try{

            $query = $this->prepare('SELECT idPromocion, promo_Codigo FROM Promocion WHERE idPromocion = :idPromocion AND promo_Codigo = :promoCodigo');
            $query->execute(['promoCodigo' => $promoCodigo, 'idPromocion' => $idPromocion]);

            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
            
        }catch(PDOException $e){
            error_log('PROMOTIONMODEL::Exists-> PDOExecption '.$e);
            return false;
        }
    }

    
    public function from($array){

        $this->id = $array['idPromocion'];
        $this->promoCodigo= $array['promo_Codigo'];
        $this->promoCantidad= $array['promo_Cantidad'];
        $this->idCas = $array['idCasa'];

    }

    public function toArray(){
        $array = [];      
        $array['idPromocion'] = $this->id;
        $array['promo_Codigo'] = $this->promoCodigo;
        $array['promo_Cantidad'] = $this->promoCantidad;
        $array['idCasa'] = $this->idCas;
        return $array;
    }






    public function setId($id){$this->id=$id;}
    public function setPromoCodigo($promoCodigo){$this->promoCodigo=$promoCodigo;}
    public function setPromoCantidad($promoCantidad){$this->promoCantidad=$promoCantidad;}
    public function setIdCas($idCas){$this->idCas=$idCas;}
    


    
    public function getIdCas(){return $this->idCas;}
    public function getPromoCantidad(){return $this->promoCantidad;}
    public function getPromoCodigo(){return $this->promoCodigo;}
    public function getId(){return $this->id;}
    

}
?>