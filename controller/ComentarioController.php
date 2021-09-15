<?php


class ComentarioController{

    public function __construct(){
        include_once ("model/ComentarioModel.php");
    }
    public function insertarComentario($descripcion, $id_noticia, $id_usuario){

        $modelo = new ComentarioModel;
        $modelo->insertarComentario($descripcion, $id_noticia, $id_usuario);
    }

    public function obtenerComentariosByIdNoticia($id_noticia){
        $modelo = new ComentarioModel;
        $row = $modelo->obtenerComentariosByIdNoticia($id_noticia);
        return $row;
    }

}