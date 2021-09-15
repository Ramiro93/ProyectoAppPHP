<?php
include_once("core/Database.php");

class SuscripcionModel{

    private $conexion;

    public function __construct() {
        $this->conexion = new Database();
    }

    public function generarSuscripcion($id_publicacion, $id_usuario, $precio) {

        $this->conexion->queryInsert("INSERT INTO FACTURA (descripcion, importe) 
                                            VALUES ('Suscripcion mensual', " . $precio . ")");

        $id_factura = $this->conexion->query("SELECT LAST_INSERT_ID() as id");

        $this->conexion->queryInsert("INSERT INTO SUSCRIPCION (id_publicacion, id_usuario, fecha_inicio, fecha_cierre, id_factura) 
                                            VALUES (" . $id_publicacion . ", " . $id_usuario . ", curdate(), curdate()+ INTERVAL 30 DAY, ". $id_factura[0]["id"] .")");

    }

    public function obtenerSuscripcionesByIdUsuario($id_usuario){
        return $this->conexion->query("SELECT id_publicacion FROM SUSCRIPCION WHERE id_usuario=" . $id_usuario ."");
    }

}