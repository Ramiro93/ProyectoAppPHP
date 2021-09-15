<?php
include_once("core/Database.php");


class UsuarioModel {

    private $conexion;

    public function __construct(){
        $this->conexion = new Database();
    }

    public function mostrarUsuarios(){
        return $this->conexion->query("SELECT * FROM USUARIO where id_rol <> 1;");
    }

    public function cambiarRol($id_usuario, $contenidista){
        $id_rol = ($contenidista=="true") ? 2 : 3;
        return $this->conexion->queryInsert("UPDATE USUARIO SET id_rol='$id_rol' where id_usuario='$id_usuario';");
    }

    public function obtenerContenidistasReporte(){
        return $this->conexion->query("SELECT U.nombre as Nombre, U.apellido as Apellido, C.email as Email FROM USUARIO U 
                                                        JOIN CUENTA C ON U.id_usuario = C.id_usuario
                                                        WHERE id_rol = 2;");
    }
    
    public function obtenerLectoresReporte(){
        return $this->conexion->query("SELECT U.nombre as Nombre, U.apellido as Apellido, C.email as Email FROM USUARIO U 
                                                        JOIN CUENTA C ON U.id_usuario = C.id_usuario
                                                        WHERE id_rol = 3;");
    }  
}

