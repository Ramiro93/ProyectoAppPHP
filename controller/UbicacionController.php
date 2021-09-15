<?php


class UbicacionController{
    public function __construct(){
        include_once ("model/UbicacionModel.php");
    }

    public function obtenerUbicaciones(){
        $modelo = new UbicacionModel();
        $row = $modelo->obtenerUbicaciones();
        return $row;
    }

}