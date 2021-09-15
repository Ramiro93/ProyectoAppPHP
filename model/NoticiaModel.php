<?php
include_once("core/Database.php");

class NoticiaModel{

    private $conexion;

    public function __construct(){

        $this->conexion = new Database();
    }

    public function crear($titulo, $descripcion, $id_seccion, $id_usuario, $ubicacion, $fecha_publicacion){
        $id_estado = 2;

        $this->conexion->queryInsert("INSERT INTO noticia 
        (titulo, descripcion, id_seccion, id_usuario, id_ubicacion, fecha_creacion, fecha_publicacion, id_estado, cantidad_likes) VALUES 
        ('" . $titulo . "','" . $descripcion . "', " . $id_seccion . ", " . $id_usuario . ", "
        . $ubicacion . ", curdate(), '" . $fecha_publicacion . "', " . $id_estado . ", 0)");

        return $this->conexion->query("SELECT LAST_INSERT_ID() as id");
    }

    public function obtenerNoticiasPorIdPublicacion($id_publicacion) {
        return $this->conexion->query("SELECT * FROM NOTICIA N 
                                            JOIN SECCION S ON N.id_seccion = S.id_seccion 
                                            JOIN PUBLICACION P ON S.id_publicacion = P.id_publicacion 
                                            JOIN UBICACION U ON N.id_ubicacion = U.id_ubicacion  
                                            JOIN USUARIO US ON N.id_usuario = US.id_usuario
                                            WHERE S.id_seccion = 1 AND P.id_publicacion =" . $id_publicacion . " AND N.id_estado = 1");
    }

    public function obtenerNoticias() {
        return $this->conexion->query("SELECT N.titulo, N.id_noticia, U.id_usuario, U.nombre, U.apellido,
                                            N.id_estado, N.fecha_creacion, S.descripcion as seccion, P.nombre as publicacion 
                                            FROM NOTICIA N
                                            JOIN SECCION S ON N.id_seccion = S.id_seccion
                                            JOIN PUBLICACION P ON S.id_publicacion = P.id_publicacion
                                            JOIN USUARIO U ON N.id_usuario = U.id_usuario");
    }

    public function getById($id_noticia) {
        return $this->conexion->query(" SELECT N.id_noticia, N.titulo, N.descripcion as contenido, N.fecha_publicacion,
                                            N.cantidad_likes, I.name_file, U.descripcion, US.nombre, US.apellido, N.id_seccion, N.id_ubicacion
                                            FROM NOTICIA N 
                                            JOIN IMAGEN I ON N.id_noticia = I.id_noticia
                                            JOIN UBICACION U ON N.id_ubicacion = U.id_ubicacion  
                                            JOIN USUARIO US ON N.id_usuario = US.id_usuario                                 
                                            WHERE N.id_noticia=" . $id_noticia . ";");
    }

    public function setImagen($id_noticia, $name) {
        return $this->conexion->queryInsert("INSERT INTO IMAGEN (id_noticia, name_file) 
                                                VALUES ( ". $id_noticia .", '" . $name . "')");
    }

    public function eliminar($id_noticia){

        return $this->conexion->queryInsert("DELETE FROM NOTICIA WHERE id_noticia = ". $id_noticia);
    }

    public function updateNoticia($titulo, $descripcion, $seccion, $ubicacion, $fecha_publicacion, $id_noticia){

        return $this->conexion->queryInsert("UPDATE NOTICIA SET titulo='$titulo', descripcion='$descripcion', 
                                            id_seccion='$seccion', id_ubicacion='$ubicacion', fecha_publicacion='$fecha_publicacion' 
                                            where id_noticia='$id_noticia';");
    }
}