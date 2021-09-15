<?php
$configuracion = parse_ini_file("../config/config.ini");
$servername = $configuracion["servername"];
$username = $configuracion["username"];
$dbname =  $configuracion["dbname"];
$password =  $configuracion["password"];

if(isset($_GET["id_noticia"])) {
    $connect = mysqli_connect($servername, $username, $password, $dbname);
    $id_estado = ($_GET["estado"]=="true") ? 1 : 2;
    $query = 'UPDATE NOTICIA SET id_estado=' . $id_estado . ' where id_noticia=' . $_GET["id_noticia"];
    $result = mysqli_query($connect, $query);
}