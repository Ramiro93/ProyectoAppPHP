<?php
include_once("core/Database.php");


class ReporteModel {

    private $conexion;

    public function __construct(){
        $this->conexion = new Database();
    }

    public function obtenerContenidistasReporte(){
        return $this->conexion->query("SELECT U.nombre as Nombre, U.apellido as Apellido, C.email as Email, COUNT(*) AS Cantidad_Noticias
                                            FROM USUARIO U
                                            JOIN CUENTA C ON U.id_usuario = C.id_usuario
                                            JOIN NOTICIA N on U.id_usuario = N.id_usuario
                                            GROUP BY U.nombre, U.apellido, C.email;");
    }
    
    public function obtenerLectoresReporte(){
        return $this->conexion->query("SELECT DISTINCT U.nombre as Nombre, U.apellido as Apellido, C.email as Email 
                                            FROM USUARIO U 
                                            JOIN CUENTA C ON U.id_usuario = C.id_usuario
                                            JOIN SUSCRIPCION S ON U.id_usuario = S.id_usuario;");
    }

    public function obtenerNoticiasReporte(){
        return $this->conexion->query("SELECT CONCAT(LEFT(N.titulo, 20), '...')  as Titulo, N.fecha_publicacion as Fecha, S.descripcion as Seccion, U.nombre as Contenidista
                                            FROM NOTICIA N
                                            JOIN SECCION S ON N.id_seccion = S.id_seccion
                                            JOIN PUBLICACION P ON S.id_publicacion = P.id_publicacion
                                            JOIN USUARIO U ON U.id_usuario = P.id_usuario
                                            WHERE N.id_estado = 1;");
    }
}

