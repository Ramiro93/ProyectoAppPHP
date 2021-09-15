<?php


class SeccionController{
    public function __construct(){
        include_once ("model/SeccionModel.php");
    }

    public function buscarSeccionesPorIdPublicacion($id_publicacion){
        $modelo = new SeccionModel();
        $row = $modelo->buscarSeccionPorIdPublicacion($id_publicacion);
        return $row;
    }

    public function crear($descripcion,$id_publicacion){
        $modelo = new SeccionModel();
        $row = $modelo->crear($descripcion,$id_publicacion);
        return $row;
    }

}