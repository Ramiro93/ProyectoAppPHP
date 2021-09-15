<?php
include_once("core/Database.php");

class PublicacionModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new Database();
    }

    public function obtenerTiposPublicacion() {
        return $this->conexion->query("SELECT * FROM TIPO_PUBLICACION");
    }

    public function obtenerPublicaciones() {
        return $this->conexion->query("SELECT * FROM PUBLICACION");
    }

    public function crear($nombre, $descripcion, $id_usuario, $id_tipo_publicacion, $precio) {
        $id_estado = 1;

        $this->conexion->queryInsert("INSERT INTO publicacion 
        (nombre, descripcion, id_usuario, id_tipo_publicacion, id_estado, fecha, precio) VALUES 
        ('" . $nombre . "', '" . $descripcion . "', " . $id_usuario . ", " . $id_tipo_publicacion . ", " . $id_estado . ", curdate(), ".$precio . ")");
    }

    public function obtenerPublicacionesPorTipo($tipo) {
        return $this->conexion->query("SELECT * FROM PUBLICACION P 
                                            JOIN TIPO_PUBLICACION T ON P.id_tipo_publicacion = T.id_tipo_publicacion
                                            WHERE T.descripcion = '" . $tipo ."'");
    }

    public function __destruct() {
        $this->conexion->close();
    }
}
