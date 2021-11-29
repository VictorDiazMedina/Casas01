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


    public function restore($archivo){
        $restorePoint=$this->limpiarCadena($archivo);
        $sql=explode(";",file_get_contents($restorePoint));
        $totalErrors=0;
        set_time_limit (60);
        $con=mysqli_connect($this->host, $this->user, $this->password, $this->db);
        $con->query("SET FOREIGN_KEY_CHECKS=0");

        for($i = 0; $i < (count($sql)-1); $i++){
            if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
        }

        $con->query("SET FOREIGN_KEY_CHECKS=1");
        $con->close();

        if($totalErrors<=0){
            return true;
        }else{
            return false;
        }

    }

    public function backup(){
        $day=date("d");
        $mont=date("m");
        $year=date("Y");
        $hora=date("H-i-s");
        $fecha=$day.'_'.$mont.'_'.$year;
        $DataBASE=$fecha."_(".$hora."_hrs).sql";
        $tables=array();
        $result=$this->sql('SHOW TABLES');
        if($result){
            while($row=mysqli_fetch_row($result)){
            $tables[] = $row[0];
            }
            $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";
            $sql.='CREATE DATABASE IF NOT EXISTS '.$this->db.";\n\n";
            $sql.='USE '.$this->db.";\n\n";;
            foreach($tables as $table){
                $result=$this->sql('SELECT * FROM '.$table);
                if($result){
                    $numFields=mysqli_num_fields($result);
                    $sql.='DROP TABLE IF EXISTS '.$table.';';
                    $row2=mysqli_fetch_row($this->sql('SHOW CREATE TABLE '.$table));
                    $sql.="\n\n".$row2[1].";\n\n";
                    for ($i=0; $i < $numFields; $i++){
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
                chmod('assets/backup/', 0777);
                $sql.='SET FOREIGN_KEY_CHECKS=1;';
                $handle=fopen('assets/backup/'.$DataBASE,'w+');
                if(fwrite($handle, $sql)){
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