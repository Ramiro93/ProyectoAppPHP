<?php
$configuracion = parse_ini_file("../config/config.ini");
$servername = $configuracion["servername"];
$username = $configuracion["username"];
$dbname =  $configuracion["dbname"];
$password =  $configuracion["password"];

if(isset($_GET["id_noticia"])) {
    $connect = mysqli_connect($servername, $username, $password, $dbname);
    $query = 'UPDATE NOTICIA SET cantidad_likes=' . $_GET["cantidad_likes"] . ' where id_noticia=' . $_GET["id_noticia"];
    $result = mysqli_query($connect, $query);
}