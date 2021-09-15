<?php
$configuracion = parse_ini_file("../config/config.ini");
$servername = $configuracion["servername"];
$username = $configuracion["username"];
$dbname =  $configuracion["dbname"];
$password =  $configuracion["password"];

if(isset($_GET["id_usuario"])) {
    $connect = mysqli_connect($servername, $username, $password, $dbname);
    $id_rol = ($_GET["contenidista"]=="true") ? 2 : 3;
    $query = 'UPDATE USUARIO SET id_rol=' . $id_rol . ' where id_usuario=' . $_GET["id_usuario"];
    $result = mysqli_query($connect, $query);
}