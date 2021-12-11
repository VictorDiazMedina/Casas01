<?php

class ContractModel extends Model implements IModel{

    private $id;
    private $contFechAct;
    private $contNombreArren;
    private $contAPaterArren;
    private $contAMaterArren;
    private $contINE;
    private $contFechEntrada;
    private $contFechSalida;
    private $contAnticipo;
    private $contMontoTotal;
    private $idPromo;
    private $idCas;


    function __construct(){
        parent::__construct();
        $this->contFechAct = '';
        $this->contNombreArren = '';
        $this->contAPaterArren = '';
        $this->contAMaterArren = '';
        $this->contINE = '';
        $this->contFechEntrada = '';
        $this->contFechSalida = '';
        $this->contAnticipo = '';
        $this->contMontoTotal = '';
        $this->idPromo = '';
        $this->idCas = '';
        
    }


    //Funciones 
    public function save(){
        try{
            $query = $this->prepare('
            INSERT INTO Contrato(cont_FechAct, cont_NombreArren, cont_APaterArren, cont_AMaterArren, cont_INE, cont_FechEntrada, cont_FechSalida, cont_Anticipo, cont_MontoTotal, idCasa) 
            VALUES(:contFechAct, :contNombreArren, :contAPaterArren, :contAMaterArren, :contINE, :contFechEntrada, :contFechSalida, :contAnticipo, :contMontoTotal, :idCas)');
            $query->execute([
                'contFechAct'  => $this->contFechAct,
                'contNombreArren'  => $this->contNombreArren,
                'contAPaterArren'  => $this->contAPaterArren,
                'contAMaterArren'  => $this->contAMaterArren,
                'contINE'  => $this->contINE,
                'contFechEntrada'  => $this->contFechEntrada,
                'contFechSalida'  => $this->contFechSalida,
                'contAnticipo'  => $this->contAnticipo,
                'contMontoTotal'  => $this->contMontoTotal,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }


    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Contrato');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ContractModel();

                $item->setId($p['idContrato']);
                $item->setContFechAct($p['cont_FechAct']);
                $item->setContNombreArren($p['cont_NombreArren']);
                $item->setContAPaterArren($p['cont_APaterArren']);
                $item->setContAMaterArren($p['cont_AMaterArren']);
                $item->setContFechEntrada($p['cont_FechEntrada']);
                $item->setContFechSalida($p['cont_FechSalida']);
                $item->setContAnticipo($p['cont_Anticipo']);
                $item->setContMontoTotal($p['cont_MontoTotal']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
    }



    public function getRentas(){
        $items = [];
        try{
            $query = $this->query('SELECT COUNT(MONTH (cont_FechEntrada)) as cont_FechEntrada, Casa.casa_Nombre as idCasa FROM Contrato INNER JOIN Casa ON Contrato.idCasa = Casa.idCasa GROUP BY Contrato.idCasa');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ContractModel();

                $item->setContFechEntrada($p['cont_FechEntrada']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
    }



    public function getEstados(){
        $items = [];
        try{
            $query = $this->query('SELECT COUNT(MONTH (cont_FechEntrada)) as cont_FechEntrada, Casa.casa_Region as idCasa FROM Contrato INNER JOIN Casa ON Contrato.idCasa = Casa.idCasa GROUP BY Contrato.idCasa');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ContractModel();

                $item->setContFechEntrada($p['cont_FechEntrada']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
    }

    public function getMes(){
        $items = [];
        try{
            $query = $this->query('SELECT MONTH (cont_FechEntrada) AS Mes FROM Contrato GROUP BY MONTH (cont_FechEntrada)');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                

                array_push($items, $p['Mes']);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
    }

    public function getContratos(){
        $items = [];
        try{
            $query = $this->query('SELECT COUNT(MONTH (cont_FechEntrada)) as Contratos FROM Contrato GROUP BY MONTH (cont_FechEntrada)');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                

                array_push($items, $p['Contratos']);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
    }

    public function getIdContract($aN, $aP, $aM, $fechE, $fechS, $idCasa){
        try{
            $query = $this->prepare('SELECT idContrato
            FROM Contrato
            WHERE cont_NombreArren = :aN AND cont_APaterArren = :aP AND cont_AMaterArren = :aM AND cont_FechEntrada = :fechE AND cont_FechSalida = :fechS AND idCasa = :idCasa');
            $query->execute(['aN'=> $aN, 'aP'=> $aP, 'aM'=> $aM, 'fechE'=> $fechE, 'fechS'=> $fechS, 'idCasa'=> $idCasa,]);
            
            $house = $query->fetch(PDO::FETCH_ASSOC);
            

            return $house['idContrato'];
        }catch(PDOException $e){
            error_log('CASAMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function get($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Contrato WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ContractModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getC($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Contrato WHERE idContrato = :id');
            $query->execute([ 'id' => $id]);
            $array = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $array['idContrato'];
            $this->contFechAct= $array['cont_FechAct'];
            $this->contNombreArren= $array['cont_NombreArren'];
            $this->contAPaterArren= $array['cont_APaterArren'];
            $this->contAMaterArren= $array['cont_AMaterArren'];
            $this->contINE= $array['cont_INE'];
            $this->contFechEntrada= $array['cont_FechEntrada'];
            $this->contFechSalida= $array['cont_FechSalida'];
            $this->contAnticipo = $array['cont_Anticipo'];
            $this->contMontoTotal= $array['cont_MontoTotal'];
            $this->idCas = $array['idCasa'];

            return $this;
            

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getContract($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Contrato WHERE idContrato = :id');
            $query->execute(['id'=> $id]);

           
                $item = $query->fetch(PDO::FETCH_ASSOC);

            return $item;

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::GetId-> PDOExecption '.$e);
        }
    }


    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Contrato WHERE idContrato = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }


    public function update(){
        try{
            $query = $this->prepare('UPDATE Contrato SET cont_NombreArren = :contNombreArren, cont_APaterArren = :contAPaterArren, cont_AMaterArren = :contAMaterArren, cont_FechEntrada = :contFechEntrada, cont_FechSalida = :contFechSalida, cont_MontoTotal = :contMontoTotal WHERE idContrato = :id');
            $query->execute([
                'id' => $this->id,
                'contNombreArren'  => $this->contNombreArren,
                'contAPaterArren'  => $this->contAPaterArren,
                'contAMaterArren'  => $this->contAMaterArren,
                'contFechEntrada'  => $this->contFechEntrada,
                'contFechSalida'   => $this->contFechSalida,
                'contMontoTotal'   => $this->contMontoTotal

            ]);

            return true;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }


 


    public function from($array){

        $this->id = $array['idContrato'];
        $this->contFechAct= $array['cont_FechAct'];
        $this->contNombreArren= $array['cont_NombreArren'];
        $this->contAPaterArren= $array['cont_APaterArren'];
        $this->contAMaterArren= $array['cont_AMaterArren'];
        $this->contINE= $array['cont_INE'];
        $this->contFechEntrada= $array['cont_FechEntrada'];
        $this->contFechSalida= $array['cont_FechSalida'];
        $this->contAnticipo = $array['cont_Anticipo'];
        $this->contMontoTotal= $array['cont_MontoTotal'];
        $this->idCas = $array['idCasa'];

    }

    public function toArray(){
        $array = [];      
        $array['idContrato'] = $this->id;
        $array['cont_FechAct'] = $this->contFechAct;
        $array['cont_NombreArren'] = $this->contNombreArren;
        $array['cont_APaterArren'] = $this->contAPaterArren;
        $array['cont_AMaterArren'] = $this->contAMaterArren;
        $array['cont_INE'] = $this->contINE;
        $array['cont_FechEntrada'] = $this->contFechEntrada;
        $array['cont_FechSalida'] = $this->contFechSalida;
        $array['cont_Anticipo'] = $this->contAnticipo;
        $array['cont_MontoTotal'] = $this->contMontoTotal;
        $array['idCasa'] = $this->idCas;
        return $array;
    }


    public function exists($contAnticipo){
        try{

            $query = $this->prepare('SELECT cont_Anticipo FROM Contrato WHERE cont_Anticipo = :contAnticipo');
            $query->execute(['contAnticipo' => $contAnticipo]);

            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
            
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::Exists-> PDOExecption '.$e);
            return false;
        }
    }



    public function verifyFechasBlock($fechaE, $fechaS, $idCont, $idCas){
        
        try{
            $query = $this->prepare('SELECT cont_FechEntrada,cont_FechSalida FROM Contrato WHERE idContrato != :idCont AND idCasa = :idCas');
            $query->execute(['idCont' => $idCont,'idCas'=> $idCas]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){


                
                $fechaInicio=strtotime(date_format(date_create($p['cont_FechEntrada']),"d-m-Y"));
                $fechaFin=strtotime(date_format(date_create($p['cont_FechSalida']),"d-m-Y"));
                for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                    
                    error_log('FECHAS BLOQUEADAS: '.date("Y-m-d", $i));
                    if($fechaE == date("Y-m-d", $i) || $fechaS == date("Y-m-d", $i)){
                        return 1;
                    }
                }
                
            }

            return 0;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
        
    }

    public function getFechasBlock($idCas){
        $arrFechas="";
        try{
            $query = $this->prepare('SELECT cont_FechEntrada,cont_FechSalida FROM Contrato WHERE idCasa = :idCas');
            $query->execute(['idCas'=> $idCas]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){


                
                $fechaInicio=strtotime(date_format(date_create($p['cont_FechEntrada']),"d-m-Y"));
                $fechaFin=strtotime(date_format(date_create($p['cont_FechSalida']),"d-m-Y"));
                for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                    $arrFechas=$arrFechas."'".date("Y-m-d", $i)."',";
                }
                
            }
            return $arrFechas;

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
        
    }

    public function getFechasBlock2($idCas){
        $arrFechas="";
        $arrayF = [];
        try{
            $query = $this->prepare('SELECT cont_FechEntrada,cont_FechSalida FROM Contrato WHERE idCasa = :idCas');
            $query->execute(['idCas'=> $idCas]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){


                
                $fechaInicio=strtotime(date_format(date_create($p['cont_FechEntrada']),"d-m-Y"));
                $fechaFin=strtotime(date_format(date_create($p['cont_FechSalida']),"d-m-Y"));
                for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                    array_push($arrayF, date("Y-m-d", $i));
                }
                
            }
            return $arrayF;

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
        
    }


    public function getFechasPend($idCas, $n){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Contrato WHERE idCasa = :idCas AND cont_FechEntrada >= CURDATE() ORDER BY cont_FechEntrada ASC LIMIT 0, :n');
            $query->execute([ 'n' => $n, 'idCas' => $idCas]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ContractModel();
                $item->from($p); 
                
                array_push($items, $item);
            }
            error_log("ContractModel::getFechasPend(): count: " . count($items));
            return $items;
        }catch(PDOException $e){
            return false;
        }
    }

    public function busqRapid($lleg, $sali){
        $items = [];
        try{
            $query = $this->prepare('SELECT idCasa FROM Contrato WHERE cont_FechEntrada = :lleg AND cont_FechSalida = :sali');
            $query->execute(['lleg'=> $lleg,'sali'=> $sali]);
            
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
               
              //$items=$items."'".$p['idCasa']."',";
               array_push($items, $p['idCasa']);
                //$items = $items.$p['casa_Nombre'].",";            


            }
            return $items;
        }catch(PDOException $e){
            error_log('CONTRACTMODEL::getAll-> PDOExecption '.$e);
        }
    }



    public function setId($id){$this->id=$id;}
    public function setContFechAct($contFechAct){$this->contFechAct=$contFechAct;}
    public function setContNombreArren($contNombreArren){$this->contNombreArren=$contNombreArren;}
    public function setContAPaterArren($contAPaterArren){$this->contAPaterArren=$contAPaterArren;}
    public function setContAMaterArren($contAMaterArren){$this->contAMaterArren=$contAMaterArren;}
    public function setContINE($contINE){$this->contINE=$contINE;}
    public function setContFechEntrada($contFechEntrada){$this->contFechEntrada=$contFechEntrada;}
    public function setContFechSalida($contFechSalida){$this->contFechSalida=$contFechSalida;}
    public function setContAnticipo($contAnticipo){$this->contAnticipo=$contAnticipo;}
    public function setIdPromo($idPromo){$this->idPromo=$idPromo;}
    public function setIdCas($idCas){$this->idCas=$idCas;}
    public function setContMontoTotal($contMontoTotal){$this->contMontoTotal=$contMontoTotal;}

    
    public function getIdCas(){return $this->idCas;}
    public function getIdPromo(){return $this->idPromo;}
    public function getContMontoTotal(){return $this->contMontoTotal;}
    public function getContAnticipo(){return $this->contAnticipo;}
    public function getContFechSalida(){return $this->contFechSalida;}
    public function getContFechEntrada(){return $this->contFechEntrada;}
    public function getContINE(){return $this->contINE;}
    public function getContAMaterArren(){return $this->contAMaterArren;}
    public function getContAPaterArren(){return $this->contAPaterArren;}
    public function getContNombreArren(){return $this->contNombreArren;}
    public function getContFechAct(){return $this->contFechAct;}
    public function getId(){return $this->id;}
    
    

}
?>