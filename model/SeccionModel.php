<?php
include_once("core/Database.php");

class SeccionModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new Database();
    }

    public function mostrarDescripcionSecciones() {
        return $this->conexion->query(" SELECT id_seccion, descripcion FROM seccion;");
    }

    public function buscarSeccionPorIdPublicacion($id_publicacion) {
        return $this->conexion->query(" SELECT * FROM seccion WHERE id_publicacion=" . $id_publicacion . ";");
    }

    public function crear($descripcion, $id_publicacion) {
        $id_estado = 1;

        $this->conexion->queryInsert("INSERT INTO seccion 
        (descripcion, id_publicacion, id_estado) VALUES 
        ('" . $descripcion . "', " . $id_publicacion  . ", " . $id_estado . ")");
    }
}
