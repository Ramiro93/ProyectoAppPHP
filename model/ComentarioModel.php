<?php
include_once("core/Database.php");

class ComentarioModel{

    private $conexion;

    public function __construct(){

        $this->conexion = new Database();
    }

    public function insertarComentario($descripcion, $id_noticia, $id_usuario){
        $this->conexion->queryInsert("INSERT INTO COMENTARIO 
        (descripcion, id_noticia, id_usuario) VALUES 
        ('" . $descripcion . "','" . $id_noticia . "', '" . $id_usuario ."' )");
    }

    public function obtenerComentariosByIdNoticia($id_noticia){
        return $this->conexion->query(" SELECT C.descripcion,U.nombre,U.apellido FROM COMENTARIO C JOIN
        USUARIO U ON C.id_usuario = U.id_usuario WHERE id_noticia=" . $id_noticia . ";");
    }

}