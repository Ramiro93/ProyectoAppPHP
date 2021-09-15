<?php

class UsuarioController{


    public function __construct(){
        include_once("model/UsuarioModel.php");
    }

    public function mostrarUsuarios(){

        $modelo = new UsuarioModel();
        try{
            $row = $modelo->mostrarUsuarios();
            return $row;
        }catch(Exception $e){
            echo "Ocurrio un error.";
        }
    }

    public function obtenerContenidistasReporte(){

        $modelo = new UsuarioModel();
        try{
            $row = $modelo->obtenerContenidistasReporte();
            return $row;
        }catch(Exception $e){
            echo "Ocurrio un error.";
        }
    }
    
    public function obtenerLectoresReporte(){

        $modelo = new UsuarioModel();
        try{
            $row = $modelo->obtenerLectoresReporte();
            return $row;
        }catch(Exception $e){
            echo "Ocurrio un error.";
        }
    }

    public function cambiarRol($id_usuario, $contenidista){

        $modelo = new UsuarioModel();
        try{
            $row = $modelo->cambiarRol($id_usuario, $contenidista);
            return $row;
        }catch(Exception $e){
            echo "Ocurrio un error.";
        }

    }
}

?>