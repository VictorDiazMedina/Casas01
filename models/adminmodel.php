<?php

class AdminModel extends database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;
    



    public function __construct(){
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->charset = constant('CHARSET');

        
    }



    //Funcion para Restaurar una base de datos
    public function restore($archivo){
        $restorePoint=$this->limpiarCadena($archivo);//Limpia inyecciones SQL
        $sql=explode(";",file_get_contents($restorePoint));//Divide despues de cada linea ";"
        $totalErrors=0;
        set_time_limit (60); //Limite de tiempo 
        $con=mysqli_connect($this->host, $this->user, $this->password, $this->db);//Conexion a la Base de datos
        $con->query("SET FOREIGN_KEY_CHECKS=0");//Deshabilita temporalmente las restricciones referenciales

        for($i = 0; $i < (count($sql)-1); $i++){//Inserccion de datos
            if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
        }

        $con->query("SET FOREIGN_KEY_CHECKS=1");
        $con->close();

        if($totalErrors<=0){//Si hay errores, no restaura
            return true;
        }else{
            return false;
        }

    }

    //Funcion para Respaldar una base de datos
    public function backup(){
        $day=date("d");//Toma el dia
        $mont=date("m");//Toma el mes
        $year=date("Y");//Toma el año
        $hora=date("H-i-s");//Toma horario
        $fecha=$day.'_'.$mont.'_'.$year;
        $DataBASE=$fecha."_(".$hora."_hrs).sql";//Nombre del archivo
        $tables=array();
        $result=$this->sql('SHOW TABLES');//Muestra las tablas de la base de datos
        if($result){
            while($row=mysqli_fetch_row($result)){//Obtiene los datos de cada tabla
                $tables[] = $row[0];
            }
            $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";//Deshabilita temporalmente las restricciones referenciales
            $sql.='CREATE DATABASE IF NOT EXISTS '.$this->db.";\n\n";//Crea la base de datos si no existe
            $sql.='USE '.$this->db.";\n\n";
            foreach($tables as $table){
                $result=$this->sql('SELECT * FROM '.$table);//Selecciona cada tabla
                if($result){
                    $numFields=mysqli_num_fields($result);//Numero de campos 
                    $sql.='DROP TABLE IF EXISTS '.$table.';';//Elimina la tabla si ya existe
                    $row2=mysqli_fetch_row($this->sql('SHOW CREATE TABLE '.$table));//Obtener una fila 
                    $sql.="\n\n".$row2[1].";\n\n";
                    for ($i=0; $i < $numFields; $i++){//Ahora realiza el proceso de crear la estructura para Insertar los datos...
                        while($row=mysqli_fetch_row($result)){
                            $sql.='INSERT INTO '.$table.' VALUES(';
                            for($j=0; $j<$numFields; $j++){
                                $row[$j]=addslashes($row[$j]);
                                $row[$j]=str_replace("\n","\\n",$row[$j]);
                                if (isset($row[$j])){
                                    $sql .= '"'.$row[$j].'"' ;
                                }
                                else{
                                    $sql.= '""';
                                }
                                if ($j < ($numFields-1)){
                                    $sql .= ',';
                                }
                            }
                            $sql.= ");\n";
                        }
                    }
                    $sql.="\n\n\n";
                }else{
                    $error=1;
                }
            }
            if($error==1){
                return FALSE;
            }else{
                chmod('assets/backup/', 0777);//Establecer permisos de leer, escribir y pueda ejecutar, en se directorio
                $sql.='SET FOREIGN_KEY_CHECKS=1;';
                $handle=fopen('assets/backup/'.$DataBASE,'w+');//abre el archivo
                if(fwrite($handle, $sql)){//escribe/sobre el archivo
                    fclose($handle);
                    return TRUE;
                }else{
                    return FALSE;
                }
            }
        }else{
            return FALSE;
        }
        mysqli_free_result($result);
    }
}

?>