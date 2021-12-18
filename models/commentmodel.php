<?php

class CommentModel extends Model implements IModel{

    private $id;
    private $commentFecha;
    private $commentNomb;
    private $commentEmail;
    private $commentText;
    private $idCas;


    function __construct(){
        parent::__construct();
        $this->commentFecha = '';
        $this->commentNomb = '';
        $this->commentEmail = '';
        $this->commentText = '';
        $this->idCas = '';
    }


    //Funciones de MODELO COMENTARIOS

    //Funcion de guardar
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO Comentario(comment_Fecha, comment_Nomb, comment_Email, comment_Text, idCasa) VALUES(:commentFecha, :commentNomb, :commentEmail, :commentText, :idCas)');
            $query->execute([
                'commentFecha'  => $this->commentFecha,
                'commentNomb'  => $this->commentNomb,
                'commentEmail'  => $this->commentEmail,
                'commentText'  => $this->commentText,
                'idCas'      => $this->idCas
            ]);
            return true;
        }catch(PDOException $e){
            error_log('CommentMODEL::save-> PDOExecption '.$e);
            return false;
        }
    }

    //Obtener todos los comentarios
    public function getAll(){
        $items = [];
        try{
            $query = $this->query('SELECT * FROM Comentario');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CommentModel();

                $item->setId($p['idComentario']);
                $item->setCommentFecha($p['comment_Fecha']);
                $item->setCommentNomb($p['comment_Nomb']);
                $item->setCommentEmail($p['comment_Email']);
                $item->setCommentText($p['comment_Text']);
                $item->setIdCas($p['idCasa']);


                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('CommentMODEL::getAll-> PDOExecption '.$e);
        }
    }

    //Obtener los comentarios de una casa especifica
    public function get($id){
        $items = [];
        try{
            $query = $this->prepare('SELECT * FROM Comentario WHERE idCasa = :id');
            $query->execute(['id'=> $id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CommentModel();
                $item->setId($p['idComentario']);
                $item->setCommentFecha($p['comment_Fecha']);
                $item->setCommentNomb($p['comment_Nomb']);
                $item->setCommentEmail($p['comment_Email']);
                $item->setCommentText($p['comment_Text']);
                $item->setIdCas($p['idCasa']);
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            error_log('CommentMODEL::GetId-> PDOExecption '.$e);
        }
    }

    //Eliminar un comentario
    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM Comentario WHERE idComentario = :id');
            $query->execute(['id'=> $id]);

            return true;
        }catch(PDOException $e){
            error_log('CommentMODEL::Delete-> PDOExecption '.$e);
            return false;
        }
    }

    //Actualizar un Comentario
    public function update(){
        try{
            $query = $this->prepare('UPDATE Comentario SET comment_Fecha = :commentFecha, comment_Nomb = :commentNomb, comment_Email = :commentEmail WHERE idComentario = :id');
            $query->execute([
                'id' => $this->id, 
                'commentFecha'  => $this->commentFecha,
                'commentNomb'  => $this->commentNomb,
                'commentEmail'  => $this->commentEmail

            ]);

            return true;
        }catch(PDOException $e){
            error_log('CommentMODEL::Update-> PDOExecption '.$e);
            return false;
        }
    }


    public function from($array){

        $this->id = $array['idComentario'];
        $this->commentFecha= $array['comment_Fecha'];
        $this->commentNomb= $array['comment_Nomb'];
        $this->commentEmail= $array['comment_Email'];
        $this->commentText= $array['comment_Text'];
        $this->idCas = $array['idCasa'];

    }

    public function toArray(){
        $array = [];      
        $array['idComentario'] = $this->id;
        $array['comment_Fecha'] = $this->commentFecha;
        $array['comment_Nomb'] = $this->commentNomb;
        $array['comment_Email'] = $this->commentEmail;
        $array['comment_Text'] = $this->commentText;
        $array['idCasa'] = $this->idCas;
        return $array;
    }






    public function setId($id){$this->id=$id;}
    public function setCommentFecha($commentFecha){$this->commentFecha=$commentFecha;}
    public function setCommentNomb($commentNomb){$this->commentNomb=$commentNomb;}
    public function setCommentEmail($commentEmail){$this->commentEmail=$commentEmail;}
    public function setCommentText($commentText){$this->commentText=$commentText;}
    public function setIdCas($idCas){$this->idCas=$idCas;}
    


    
    public function getIdCas(){return $this->idCas;}
    public function getCommentText(){return $this->commentText;}
    public function getCommentEmail(){return $this->commentEmail;}
    public function getCommentNomb(){return $this->commentNomb;}
    public function getCommentFecha(){return $this->commentFecha;}
    public function getId(){return $this->id;}
    

}
?>