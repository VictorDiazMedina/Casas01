<?php

class JoinCasaModel extends Model{
    //CASA
    private $idCasa;
    private $casaNombre;
    private $casaDireccion;

    //ANFITRION
    private $idAnf;
    private $anfNombre;
    private $anfAP;
    private $anfAM;
    private $anfFechNac;
    private $anfINE;
    private $anfWApp;


    public function __construct(){
        parent::__construct();
    }

    public function getCasa_Anf($idAnf){
        $items = [];
        try{
            $query = $this->prepare('SELECT casa_Nombre, casa_Direccion, anf_Nombre FROM casa INNER JOIN anfitrion WHERE casa.idanfitrion = :idAnf');
            $query->execute([
                'idAnf'=> $idAnf
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new JoinCasaModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        }catch(PDOexception $e){
            return NULL;
        }
    }

    public function from($array){
        $this->casaNombre = $array['casa_Nombre'];        
        $this->casaDireccion = $array['casa_Direccion'];        
        $this->anfNombre = $array['anf_Nombre'];
    }

    public function toArray(){
        $array = [];

        $array['casa_Nombre'] = $this->casaNombre;        
        $array['casa_Direccion'] = $this->casaDireccion;        
        $array['anf_Nombre'] = $this->anfNombre;

        return $array;
    }

    //CASA
    public function setIdCasa($value){$this->idCasa=$value;}
    public function setCasaNombre($value){$this->casaNombre=$value;}    
    public function setCasaDireccion($value){$this->casaDireccion=$value;}

    public function getIdCasa(){return $this->$idCasa;}
    public function getCasaNombre(){return $this->casaNombre;}     
    public function getCasaDireccion(){return $this->casaDireccion;}   

    //ANFITRION
    public function setIdAnf($value){$this->idAnf=$value;}
    public function setNombreAnf($value){$this->anfNombre=$value;}
    
    public function getIdAnf(){return $this->idAnf;}    
    public function getNombreAnf(){return $this->anfNombre;}
    
    

}
?>