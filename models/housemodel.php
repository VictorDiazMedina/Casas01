<?php

class HouseModel extends Model implements IModel{

    private $id;
    private $casaNombre;
    private $casaDescrip;
    private $casaLati;
    private $casaLong;
    private $casaRegion;  
    private $casaLogo;   
    private $casaRenta;
    private $casaDeposito;

    private $idUsuario;


    function __construct(){
        parent::__construct();
        $this->casaNombre = '';
        $this->casaDescrip = '';
        $this->casaLati = '';
        $this->casaLong = '';
        $this->casaRegion = '';
        $this->casaLogo = '';
        $this->casaRenta = '';
        $this->casaDeposito = '';
        $this->idUsuario = '';
    }


    //Funciones de MODELO CASAS

    //Funcion para guardar
    public function save(){
        try{
            $query = $this->prepare('
            INSERT INTO Casa(casa_Nombre,casa_Lati,idUsuario) 
            VALUES(:casaNombre, :casaLati, :idUsuario)');
            $query->execute([
                'casaNombre'  => $this->casaNombre, 
                'casaLati'  => $this->casaLati,
                'idUsuario'  => $this->idUsuario
            ]);
            return true;
        }catch(PDOException $e){
            error_log('CASAMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }
 
    //Crea una nueva casa con respecto al Usuario
    public function newHouse($idUser){
        try{
            $query = $this->prepare('
            INSERT INTO Casa(casa_Nombre,casa_Lati,casa_Long, idUsuario, casa_Region) 
            VALUES(:casaNombre, :casaLati, :casaLong, :idUsuario, :casaRegion)');
            $query->execute([
                'casaNombre'  => $this->casaNombre, 
                'casaLati'  => 19.433771365027386,
                'casaLong'  =>-99.14442156921884,
                'idUsuario'  => $idUser,
                'casaRegion'  => "Ciudad de México"
            ]);
            return true;
        }catch(PDOException $e){
            error_log('CASAMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }

    //Obtener todas la casas
    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Casa');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new HouseModel();


                $item->setId($p['idCasa']);
                $item->setCasaNombre($p['casa_Nombre']);
                $item->setCasaDescrip($p['casa_Descripcion']);
                $item->setCasaLati($p['casa_Lati']);                
                $item->setCasaLong($p['casa_Long']);                              
                $item->setCasaRegion($p['casa_Region']);                        
                $item->setCasaRenta($p['casa_Renta']);                        
                $item->setCasaDeposito($p['casa_Deposito']);
                $item->setIdUsuario($p['idUsuario']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CASAMODEL::getAll-> PDOExecption '.$e);
        }
    }

    //Obtener un casa especifica
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM Casa WHERE idCasa = :id');
            $query->execute(['id'=> $id]);
            
            $house = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($house['idCasa']);
            $this->setCasaNombre($house['casa_Nombre']);
            $this->setCasaDescrip($house['casa_Descripcion']);
            $this->setCasaLati($house['casa_Lati']);            
            $this->setCasaLong($house['casa_Long']);                         
            $this->setCasaRegion($house['casa_Region']);                     
            $this->setCasaLogo($house['casa_Logo']);                   
            $this->setCasaRenta($house['casa_Renta']);                    
            $this->setCasaDeposito($house['casa_Deposito']);
            $this->setIdUsuario($house['idUsuario']);

            return $this;
        }catch(PDOException $e){
            error_log('CASAMODEL::GetId-> PDOExecption '.$e);
        }
    }

    //Obtener un casa especifica
    public function getH($id){
        try{
            $query = $this->prepare('SELECT * FROM Casa WHERE idCasa = :id');
            $query->execute(['id'=> $id]);
            $array = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $array['idCasa'];
            $this->casaNombre= $array['casa_Nombre'];
            $this->casaDescrip= $array['casa_Descripcion'];
            $this->casaLati= $array['casa_Lati'];
            $this->casaLong= $array['casa_Long'];
            $this->casaRegion= $array['casa_Region'];
            $this->casaLogo= $array['casa_Logo'];
            $this->casaRenta= $array['casa_Renta'];
            $this->casaDeposito= $array['casa_Deposito'];
            $this->idUsuario= $array['idUsuario'];

            return $this;
        }catch(PDOException $e){
            error_log('CASAMODEL::GetId-> PDOExecption '.$e);
        }
    }

    //Obtener una casa con respecto al Usuario
    public function getIdHouse($id){
        try{
            $query = $this->prepare('SELECT idCasa FROM Casa WHERE idUsuario = :id');
            $query->execute(['id'=> $id]);
            
            $house = $query->fetch(PDO::FETCH_ASSOC);
            

            return $house['idCasa'];
        }catch(PDOException $e){
            error_log('CASAMODEL::GetId-> PDOExecption '.$e);
        }
    }

    //Obtener una casa con respecto al id de Casa
    public function getIdCasa($id){
        
        try{
            $query = $this->prepare('SELECT idCasa FROM Casa WHERE idCasa = :id');
            $query->execute(['id'=> $id]);
            
            $house = $query->fetch(PDO::FETCH_ASSOC);
            

            return $house['idCasa'];
        }catch(PDOException $e){
            error_log('CASAMODEL::GetId-> PDOExecption '.$e);
        }
    }
    
    //Obtener una casa con respecto al Usuario
    public function getIdUser($id){
        try{
            $query = $this->prepare('SELECT * FROM Casa WHERE idUsuario = :id');
            $query->execute(['id'=> $id]);
            
            $house = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($house['idCasa']);
            $this->setCasaNombre($house['casa_Nombre']);
            $this->setCasaDescrip($house['casa_Descripcion']);
            $this->setCasaLati($house['casa_Lati']);            
            $this->setCasaLong($house['casa_Long']);                     
            $this->setCasaRegion($house['casa_Region']);                  
            $this->setCasaLogo($house['casa_Logo']);                  
            $this->setCasaRenta($house['casa_Renta']);                    
            $this->setCasaDeposito($house['casa_Deposito']);            
            $this->setIdUsuario($house['idUsuario']);

            return $this;
        }catch(PDOException $e){
            error_log('CASAMODEL::GetId-> PDOExecption '.$e);
        }
    }

    //Eliminar una casa
    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Casa WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('CASAMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }

    //Actualizar un casa
    public function update(){
        try{
            $query = $this->prepare('UPDATE Casa SET casa_Nombre = :casaNombre, casa_Renta = :casaRenta, casa_Deposito = :casaDeposito, casa_Lati = :casaLati, casa_Long = :casaLong,  casa_Region = :casaRegion WHERE idCasa = :id');
            $query->execute([
                'id' => $this->id,
                'casaNombre'  => $this->casaNombre, 
                'casaRenta'  => $this->casaRenta, 
                'casaDeposito'  => $this->casaDeposito, 
                'casaLati'  => $this->casaLati, 
                'casaLong'  => $this->casaLong,
                'casaRegion'  => $this->casaRegion

            ]);

            return true;
        }catch(PDOException $e){
            error_log('CASAMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }

    //Actualizar descripcion de una casa
    public function updateDescrip(){
        try{
            $query = $this->prepare('UPDATE Casa SET casa_Descripcion = :casaDescrip WHERE idCasa = :id');
            $query->execute([
                'id' => $this->id,
                'casaDescrip'  => $this->casaDescrip
            ]);

            return true;
        }catch(PDOException $e){
            error_log('CASAMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }

    //Consulta las casas que no se encuentran al especificar
    public function busqCasas($noCasas){
        $place_holders = implode(',', array_fill(0, count($noCasas), '?'));
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM Casa WHERE idCasa NOT IN ($place_holders)");
            $query->execute($noCasas);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new HouseModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('HouseModel::BusqCasas-> PDOExecption '.$e);
        }
    }

    //Conuslta casas por Region
    public function busqCasasRegion($regionCasa){
        $items = [];
        try{
            $query = $this->prepare("SELECT * FROM Casa WHERE casa_Region = :regionCasa");
            $query->execute(['regionCasa'  => $regionCasa]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new HouseModel();
                
                $item->from($p);
                array_push($items, $item);
            }
            return $items;

        }catch(PDOException $e){
            error_log('HouseModel::BusqCasas-> PDOExecption '.$e);
        }
    }

    //Obtener todas la casas
    public function getCasas(){


        $items = [];
        try{
            $query = $this->query('SELECT * FROM Casa');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new HouseModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('HouseModel::BusqCasas-> PDOExecption '.$e);
        }
    }

    //Actualizar logo de una casa
    function updateLogo($casaLogo, $id){
        try{
            $query = $this->db->connect()->prepare('UPDATE Casa SET casa_Logo = :casaLogo WHERE idCasa = :id');
            $query->execute(['casaLogo' => $casaLogo, 'id' => $id]);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }
       
    //Busqueda de casas por datos especificos
    public function busqRapid($ubi, $lleg, $sali){
        $ubi2 = $ubi;
        $lleg2 = $lleg;
        $sali2 = $sali;
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Casa
            WHERE casa_Region = :ubi AND Casa.idCasa NOT IN (SELECT Contrato.idCasa
            FROM Casa
            INNER JOIN Contrato ON Contrato.idCasa = Casa.idCasa
            WHERE casa_Region = :ubi2 AND cont_FechEntrada BETWEEN :lleg2 AND :sali2 or cont_FechSalida BETWEEN :lleg AND :sali)');
            $query->execute(['ubi'=> $ubi,'lleg'=> $lleg,'sali'=> $sali, 'ubi2'=> $ubi2,'lleg2'=> $lleg2,'sali2'=> $sali2]);
            
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
               
                $item = new HouseModel();
                $item->from($p);
                array_push($items, $item);           


            }
            return $items;
        }catch(PDOException $e){
            error_log('CASAMODEL::getAll-> PDOExecption '.$e);
        }
    }



    public function from($array){

        $this->id = $array['idCasa'];
        $this->casaNombre= $array['casa_Nombre'];
        $this->casaDescrip= $array['casa_Descripcion'];
        $this->casaLati= $array['casa_Lati'];
        $this->casaLong= $array['casa_Long'];
        $this->casaRegion= $array['casa_Region'];
        $this->casaLogo= $array['casa_Logo'];
        $this->casaRenta= $array['casa_Renta'];
        $this->casaDeposito= $array['casa_Deposito'];
        $this->idUsuario= $array['idUsuario'];

    }
    
    public function toArray(){
        $array = [];      
        $array['idCasa'] = $this->id;
        $array['casa_Nombre'] = $this->casaNombre;
        $array['casa_Descripcion'] = $this->casaDescrip;
        $array['casa_Lati'] = $this->casaLati;
        $array['casa_Long'] = $this->casaLong;
        $array['casa_Region'] = $this->casaRegion;
        $array['casa_Logo'] = $this->casaLogo;
        $array['casa_Renta'] = $this->casaRenta;
        $array['casa_Deposito'] = $this->casaDeposito;
        $array['idUsuario'] = $this->idUsuario;
        return $array;
    }


   

    public function setId($id){$this->id=$id;}
    public function setCasaNombre($casaNombre){$this->casaNombre=$casaNombre;}
    public function setCasaDescrip($casaDescrip){$this->casaDescrip=$casaDescrip;}
    public function setCasaLati($casaLati){$this->casaLati=$casaLati;}    
    public function setCasaLong($casaLong){$this->casaLong=$casaLong;}  
    public function setCasaRegion($casaRegion){$this->casaRegion=$casaRegion;}
    public function setCasaLogo($casaLogo){$this->casaLogo=$casaLogo;}
    public function setCasaRenta($casaRenta){$this->casaRenta=$casaRenta;}
    public function setCasaDeposito($casaDeposito){$this->casaDeposito=$casaDeposito;}
    public function setIdUsuario($idUsuario){$this->idUsuario=$idUsuario;}
    

    public function getIdUsuario(){return $this->idUsuario;}
    public function getCasaDeposito(){return $this->casaDeposito;}
    public function getCasaRenta(){return $this->casaRenta;}
    public function getCasaLogo(){return $this->casaLogo;}
    public function getCasaRegion(){return $this->casaRegion;}
    public function getCasaLati(){return $this->casaLati;}
    public function getCasaLong(){return $this->casaLong;}
    public function getCasaNombre(){return $this->casaNombre;}
    public function getCasaDescrip(){return $this->casaDescrip;}
    public function getId(){return $this->id;}
    

}
?>