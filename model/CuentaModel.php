<?php
include_once("core/Database.php");

class CuentaModel {
    private $conexion;

    public function __construct(){
        $this->conexion = new Database();
    }

    public function login($email, $password) {
        return $this->conexion->query(
            "SELECT U.id_usuario, C.email, U.nombre, U.apellido, R.descripcion as rol FROM CUENTA C
                    JOIN USUARIO U on C.id_usuario = U.id_usuario
                    JOIN ROL R on R.id_rol = U.id_rol
                    WHERE email='". $email ."' AND password='". $password ."'");
    }

    public function registrar($email,$password,$nombre,$apellido,$rol){
        switch($rol){
            
            case "lector": 
                $rol = 3;
                break;
            case "contenidista":
                $rol = 2;
                break;
            case "admin":
                $rol = 1;
                break;    
        }
        $this->conexion->queryInsert("INSERT INTO USUARIO 
        (nombre, apellido, id_rol) VALUES ('".$nombre."', '".$apellido."', ".$rol.")");

        $idUsuario = $this->conexion->query("SELECT LAST_INSERT_ID() as id");

        $this->conexion->queryInsert("INSERT INTO CUENTA 
        (email, password,id_usuario) VALUES ('".$email."', '".$password."', ".$idUsuario[0]["id"].")");
    
}
        
    public function __destruct(){
        $this->conexion->close();
    }
}