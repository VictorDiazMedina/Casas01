<?php

class UserModel extends Model implements IModel{

    private $id;
    private $userNomb;
    private $userAp;
    private $userAm;
    private $userFechNac;
    private $userPerfil;
    private $userINE;
    private $userWhats;
    private $userPass;
    private $userStatus;
    private $role;


    function __construct(){
        parent::__construct();
        $this->userNomb = '';
        $this->userAp = '';
        $this->userAm = '';
        $this->userFechNac = '';
        $this->userPerfil = '';
        $this->userINE = '';
        $this->userWhats = '';
        $this->userPass = '';
        $this->userStatus = '';
        $this->role = '';
    }



    //Funciones de MODELO USUARIO

    //Función para guardar 
    public function save(){
        try{
            $query = $this->prepare('
            INSERT INTO Usuario(user_Nombre,user_APaterno,user_AMaterno,user_INE,user_WhatsApp,user_Password,user_Status,user_Role) 
            VALUES(:userNomb, :userAp, :userAm, :userINE, :userWhats, :userPass, :userStatus, :role)');
            $query->execute([
                'userNomb'  => $this->userNomb, 
                'userAp'  => $this->userAp,
                'userAm'  => $this->userAm,
                'userINE'  => $this->userINE,
                'userWhats'  => $this->userWhats,
                'userPass'  => $this->userPass,
                'userStatus'  => $this->userStatus,
                'role'      => $this->role
            ]);
            
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }

    //Función para obtener todos los registros de la tabla 
    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Usuario');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();


                $item->setId($p['idUsuario']);
                $item->setUserNomb($p['user_Nombre']);
                $item->setUserAp($p['user_APaterno']);
                $item->setUserAm($p['user_AMaterno']);
                $item->setUserFechNac($p['user_FechNac']);
                $item->setUserPerfil($p['user_Perfil']);
                $item->setUserINE($p['user_INE']);
                $item->setUserWhats($p['user_WhatsApp']);
                $item->setUserPassword($p['user_Password'], false);
                $item->setUserStatus($p['user_Status']);
                $item->setRole($p['user_Role']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL::getAll-> PDOExecption '.$e);
        }
    }

    //Función para obtener  un registro específico
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM Usuario WHERE idUsuario = :id');
            $query->execute(['id'=> $id]);
            
            $user = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->setId($user['idUsuario']);
            $this->setUserNomb($user['user_Nombre']);
            $this->setUserAp($user['user_APaterno']);
            $this->setUserAm($user['user_AMaterno']);
            $this->setUserFechNac($user['user_FechNac']);
            $this->setUserPerfil($user['user_Perfil']);
            $this->setUserINE($user['user_INE']);
            $this->setUserWhats($user['user_WhatsApp']);
            $this->setUserPassword($user['user_Password'], false);
            $this->setUserStatus($user['user_Status']);
            $this->setRole($user['user_Role']);

            return $this;
        }catch(PDOException $e){
            error_log('USERMODEL::GetId-> PDOExecption '.$e);
        }
    }

    //Función para eliminar un registro específico
    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Usuario WHERE idUsuario = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }

    //Función para actualizar
    public function update(){
        try{
            $query = $this->prepare('UPDATE Usuario SET user_Nombre = :userNomb, user_APaterno = :userAp, user_AMaterno = :userAm, user_FechNac = :userFechNac, user_INE = :userINE, user_WhatsApp = :userWhats, user_Password = :userPass WHERE idUsuario = :id');
            $query->execute([
                'id' => $this->id,
                'userNomb'  => $this->userNomb, 
                'userAp'  => $this->userAp,
                'userAm'  => $this->userAm,
                'userFechNac'  => $this->userFechNac,
                'userINE'  => $this->userINE,
                'userWhats'  => $this->userWhats,
                'userPass'  => $this->userPass

            ]);

            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }

    //Verifica la existencia de un registro
    public function exists($userWhats){
        try{

            $query = $this->prepare('SELECT user_WhatsApp FROM Usuario WHERE user_WhatsApp = :userWhats');
            $query->execute(['userWhats' => $userWhats]);

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

    
    public function getAnfiInicio(){
        $items = [];
        try{
            $query = $this->query('SELECT Usuario.idUsuario, user_Nombre, user_APaterno, user_AMaterno, user_FechNac, user_Perfil, user_INE, user_WhatsApp, Casa.casa_Nombre as user_Password, Casa.idCasa as user_Status, user_Role
            FROM Casa
            INNER JOIN Usuario ON Usuario.idUsuario = Casa.idUsuario
            WHERE user_Role = "user" ');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();


                $item->setId($p['idUsuario']);
                $item->setUserNomb($p['user_Nombre']);
                $item->setUserAp($p['user_APaterno']);
                $item->setUserAm($p['user_AMaterno']);
                $item->setUserFechNac($p['user_FechNac']);
                $item->setUserPerfil($p['user_Perfil']);
                $item->setUserINE($p['user_INE']);
                $item->setUserWhats($p['user_WhatsApp']);
                $item->setUserPassword($p['user_Password'], false);
                $item->setUserStatus($p['user_Status']);
                $item->setRole($p['user_Role']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL::getAll-> PDOExecption '.$e);
        }
    }

    public function getAnfi(){
        $items = [];
        try{
            $query = $this->query('SELECT Usuario.idUsuario, user_Nombre, user_APaterno, user_AMaterno, Casa.casa_Nombre as user_FechNac, user_Perfil, user_INE, user_WhatsApp, user_Password, user_Status, user_Role
            FROM Casa
            INNER JOIN Usuario ON Usuario.idUsuario = Casa.idUsuario
            WHERE user_Role = "user" ');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();


                $item->setId($p['idUsuario']);
                $item->setUserNomb($p['user_Nombre']);
                $item->setUserAp($p['user_APaterno']);
                $item->setUserAm($p['user_AMaterno']);
                $item->setUserFechNac($p['user_FechNac']);
                $item->setUserPerfil($p['user_Perfil']);
                $item->setUserINE($p['user_INE']);
                $item->setUserWhats($p['user_WhatsApp']);
                $item->setUserPassword($p['user_Password'], false);
                $item->setUserStatus($p['user_Status']);
                $item->setRole($p['user_Role']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL::getAll-> PDOExecption '.$e);
        }
    }


    public function getUser($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Usuario WHERE idUsuario = :id');
            $query->execute(['id'=> $id]);

           
                $item = $query->fetch(PDO::FETCH_ASSOC);

            return $item;

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::GetId-> PDOExecption '.$e);
        }
    }

    public function getU($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Usuario WHERE idUsuario = :id');
            $query->execute([ 'id' => $id]);
            $array = $query->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $array['idUsuario'];
            $this->userNomb= $array['user_Nombre'];
            $this->userAp= $array['user_APaterno'];
            $this->userAm= $array['user_AMaterno'];

            return $this;
            

        }catch(PDOException $e){
            error_log('CONTRACTMODEL::GetId-> PDOExecption '.$e);
        }
    }



    public function toArray(){
        $array = [];      

        $array['idUsuario'] = $this->id;
        $array['user_Nombre'] = $this->userNomb;
        $array['user_APaterno'] = $this->userAp;
        $array['user_AMaterno'] = $this->userAm;
        $array['user_FechNac'] = $this->userFechNac;
        $array['user_Perfil'] = $this->userPerfil;
        $array['user_INE'] = $this->userINE;
        $array['user_WhatsApp'] = $this->userWhats;
        $array['user_Password'] = $this->userPass;
        $array['user_Status'] = $this->userStatus;
        $array['user_Role'] = $this->role;

        return $array;
    }


    
    public function updateStatus(){
        try{
            $query = $this->prepare('UPDATE Usuario SET user_Status = :userStatus WHERE idUsuario = :id');
            $query->execute([
                'id' => $this->id,
                'userStatus'  => $this->userStatus

            ]);

            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }


    function updatePhoto($userPerfil, $id){
        try{
            $query = $this->db->connect()->prepare('UPDATE Usuario SET user_Perfil = :userPerfil WHERE idUsuario = :id');
            $query->execute(['userPerfil' => $userPerfil, 'id' => $id]);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }


    public function from($array){

        $this->id = $array['idUsuario'];
        $this->userNomb= $array['user_Nombre'];
        $this->userAp= $array['user_APaterno'];
        $this->userAm= $array['user_AMaterno'];
        $this->userFechNac= $array['user_FechNac'];
        $this->userPerfil= $array['user_Perfil'];
        $this->userINE= $array['user_INE'];
        $this->userWhats = $array['user_WhatsApp'];
        $this->userPass= $array['user_Password'];
        $this->userStatus= $array['user_Status'];
        $this->role = $array['user_Role'];

    }


    
    public function idWhats($userWhats){
        $idU;
        try{
            
            $query = $this->prepare('SELECT idUsuario FROM Usuario WHERE user_WhatsApp = :userWhats');
            $query->execute(['userWhats' => $userWhats]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $idU = $p['idUsuario'];
            }
            return $idU;
        }catch(PDOException $e){
            error_log('USERMODEL::getIdWhats-> PDOExecption '.$e);
        }

    }


    public function comparePassword($userPass, $id){
        try{

            $user = $this->get($id);
            return password_verify($userPass, $user->getUserPass());
            
        }catch(PDOException $e){
            error_log('USERMODEL::Exists-> PDOExecption '.$e);
            return false;
        }
    }


    private function getHashedPassword($userPass){
        return password_hash($userPass, PASSWORD_DEFAULT, ['cost' => 10]);
    }



    public function setId($id){$this->id=$id;}
    public function setUserNomb($userNomb){$this->userNomb=$userNomb;}
    public function setUserAp($userAp){$this->userAp=$userAp;}
    public function setUserAm($userAm){$this->userAm=$userAm;}
    public function setUserFechNac($userFechNac){$this->userFechNac=$userFechNac;}
    public function setUserPerfil($userPerfil){$this->userPerfil=$userPerfil;}
    public function setUserINE($userINE){$this->userINE=$userINE;}
    public function setUserWhats($userWhats){$this->userWhats=$userWhats;}
    public function setUserStatus($userStatus){$this->userStatus=$userStatus;}
    public function setRole($role){$this->role=$role;}
    

    public function setUserPassword($userPass, $hash = true){ 
        if($hash){
            $this->userPass = $this->getHashedPassword($userPass);
        }else{
            $this->userPass = $userPass;
        }
    }

    
    public function getRole(){return $this->role;}
    public function getUserStatus(){return $this->userStatus;}
    public function getUserPass(){return $this->userPass;}
    public function getUserWhats(){return $this->userWhats;}
    public function getUserINE(){return $this->userINE;}
    public function getUserPerfil(){return $this->userPerfil;}
    public function getUserFechNac(){return $this->userFechNac;}
    public function getUserAm(){return $this->userAm;}
    public function getUserAp(){return $this->userAp;}
    public function getUserNomb(){return $this->userNomb;}
    public function getId(){return $this->id;}
    

}
?>