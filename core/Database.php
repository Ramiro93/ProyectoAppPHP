<?php

class Database{

    private $conexion;

    public function __construct(){
        $configuracion = parse_ini_file("config/config.ini");
        $servername = $configuracion["servername"];
        $username = $configuracion["username"];
        $dbname =  $configuracion["dbname"];
        $password =  $configuracion["password"];

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $this->conexion = $conn;
    }

    public function query($sql){
        $result = mysqli_query($this->conexion, $sql);    
        $resultado = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $resultado;
    }

    public function queryInsert($sql){
        if (mysqli_query( $this->conexion , $sql)) {
         } else {
            echo "Error: " . $sql . "" . mysqli_error($this->conexion);
         }

    }


    public function close(){
        mysqli_close($this->conexion);
    }
}