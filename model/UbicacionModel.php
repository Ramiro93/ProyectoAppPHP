<?php
include_once("core/Database.php");

class UbicacionModel {
    private $conexion;

    public function __construct() {
        $this->conexion = new Database();
    }

    public function obtenerUbicaciones() {
        return $this->conexion->query(" SELECT * FROM ubicacion;");
    }
}
