<?php

class PublicacionController {
    public function __construct(){
        include_once("model/PublicacionModel.php");
    }

    public function obtenerTiposPublicacion(){
        $modelo = new PublicacionModel();
        try {
            return $modelo->obtenerTiposPublicacion();
        } catch (Exception $e) {
            echo "No se pudieron obtener los tipos de publicacion";
        }
    }

    public function obtenerPublicaciones(){
        $modelo = new PublicacionModel();
        try {
            return $modelo->obtenerPublicaciones();
        } catch (Exception $e) {
            echo "No se pudieron obtener las publicaciones";
        }
    }

    public function crear($nombre,$descripcion,$usuario_id,$id_tipo_publicacion,$precio){
        $modelo = new PublicacionModel();
        try{
            $modelo->crear($nombre,$descripcion,$usuario_id,$id_tipo_publicacion,$precio);
        }catch(Exception $e){
            echo "No se pudo crear la publicación";
        }    
    }

    public function obtenerPublicacionesPorTipo($tipo) {
        $modelo = new PublicacionModel();
        try{
            return $modelo->obtenerPublicacionesPorTipo($tipo);
        }catch(Exception $e){
            echo "No se encontraron publicaciones";
        }
    }
}