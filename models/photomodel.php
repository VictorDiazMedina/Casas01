<?php

class PhotoModel extends Model implements IModel{

    private $id;
    private $imgTipo;
    private $imgUrl;
    private $idCas;


    function __construct(){
        parent::__construct();
        $this->imgTipo = '';
        $this->imgUrl = '';
        $this->idCas = '';
    }


    //Funciones 
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Fotografia(img_Tipo, img_Url, idCasa) VALUES(:imgTipo, :imgUrl, :idCas)');
            $query->execute([
                'imgTipo'  => $this->imgTipo,
                'imgUrl'  => $this->imgUrl,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('PhotoMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }


    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Fotografia');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PhotoModel();

                $item->setId($p['idFotografia']);
                $item->setImgTipo($p['img_Tipo']);
                $item->setImgUrl($p['img_Url']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('PhotoMODEL::getAll-> PDOExecption '.$e);
        }
    }
    

    public function get($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Fotografia WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PhotoModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('PhotoMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getImg($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT img_Url, img_Tipo FROM Fotografia WHERE img_Tipo = "header" OR img_Tipo = "right1" OR img_Tipo = "right2" AND idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PhotoModel();
                
                $item->setImgTipo($p['img_Tipo']);
                $item->setImgUrl($p['img_Url']);;
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('PhotoMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function uploadImg(){
        try{
            $query = $this->prepare('INSERT INTO Fotografia(img_Tipo, img_Url, idCasa) VALUES(:imgTipo, :imgUrl, :idCas)');
            $query->execute([
                'imgTipo'  => $this->imgTipo,
                'imgUrl'  => $this->imgUrl,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('PhotoMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }

    public function getGallery($imgTipo,$idCas){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Fotografia WHERE img_Tipo = :imgTipo AND idCasa = :idCas');
            $query->execute(['imgTipo' => $imgTipo, 'idCas' => $idCas ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PhotoModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('PhotoMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getPhoto($imgTipo, $idCas){
        try{
            $query = $this->prepare('SELECT * FROM Fotografia WHERE img_Tipo = :imgTipo AND idCasa = :idCas');
            $query->execute(['imgTipo' => $imgTipo, 'idCas' => $idCas ]);
            
            $p = $query->fetch(PDO::FETCH_ASSOC);
            
            return $p;

        }catch(PDOException $e){
            error_log('PhotoMODEL::GetId-> PDOExecption '.$e);
        }
    }
    
    public function getUrlPhoto($imgTipo, $idCas){
        try{
            $query = $this->prepare('SELECT img_Url FROM Fotografia WHERE img_Tipo = :imgTipo AND idCasa = :idCas');
            $query->execute(['imgTipo' => $imgTipo, 'idCas' => $idCas ]);
            
            $p = $query->fetch(PDO::FETCH_ASSOC);
            
            return $p['img_Url'];

        }catch(PDOException $e){
            error_log('PhotoMODEL::GetId-> PDOExecption '.$e);
        }
    }


    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Fotografia WHERE idFotografia = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('PhotoMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }


    public function update(){
        try{
            $query = $this->prepare('UPDATE Fotografia SET img_Url = :imgUrl, img_Tipo = :imgTipo, idCasa = :idCas WHERE idFotografia = :id');
            $query->execute([
                'id' => $this->id,
                'idCas' => $this->idCas,  
                'imgTipo' => $this->imgTipo, 
                'imgUrl'  => $this->imgUrl

            ]);

            return true;
        }catch(PDOException $e){
            error_log('PhotoMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }

    public function exists($imgTipo, $idCas){
        try{

            $query = $this->prepare('SELECT img_Tipo FROM Fotografia WHERE img_Tipo = :imgTipo AND idCasa = :idCas');
            $query->execute(['imgTipo' => $imgTipo, 'idCas' => $idCas]);

            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
            
        }catch(PDOException $e){
            error_log('USERMODEL::Exists-> PDOExecption '.$e);
            return false;
        }
    }

    


    public function busqCasas($casa){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Fotografia WHERE idCasa = :casa AND img_Tipo="galeria" LIMIT 0,4');
            $query->execute(['casa' => $casa]);
            $n=0;
            $row_count = $query->rowCount();
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $n=$n+1;
                    $item = new PhotoModel();
                    $item->setId($n);
                    $item->setImgTipo($p['img_Tipo']);
                    $item->setImgUrl($p['img_Url']);
                    $item->setIdCas($p['idCasa']);
                    
                    array_push($items, $item);
                
                
            }

            if($row_count == 0){ 
                for($i = 0; $i < 4; ++$i) {
                    $item = new PhotoModel();
                    $item->setId($i+1);
                    $item->setImgTipo('1');
                    $item->setImgUrl('1');
                    $item->setIdCas($casa);
                    array_push($items, $item);
                }

            }
            return $items;
        }catch(PDOException $e){
            error_log('PhotoMODEL::getAll-> PDOExecption '.$e);
        }
    }
 


    public function from($array){

        $this->id = $array['idFotografia'];
        $this->imgTipo= $array['img_Tipo'];
        $this->imgUrl= $array['img_Url'];
        $this->idCas = $array['idCasa'];

    }

    public function toArray(){
        $array = [];      
        $array['idFotografia'] = $this->id;
        $array['img_Tipo'] = $this->imgTipo;
        $array['img_Url'] = $this->imgUrl;
        $array['idCasa'] = $this->idCas;
        return $array;
    }






    public function setId($id){$this->id=$id;}
    public function setImgTipo($imgTipo){$this->imgTipo=$imgTipo;}
    public function setImgUrl($imgUrl){$this->imgUrl=$imgUrl;}
    public function setIdCas($idCas){$this->idCas=$idCas;}
    


    
    public function getIdCas(){return $this->idCas;}
    public function getImgUrl(){return $this->imgUrl;}
    public function getImgTipo(){return $this->imgTipo;}
    public function getId(){return $this->id;}
    

}
?>