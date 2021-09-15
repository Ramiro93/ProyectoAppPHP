<?php
$configuracion = parse_ini_file("../config/config.ini");
$servername = $configuracion["servername"];
$username = $configuracion["username"];
$dbname =  $configuracion["dbname"];
$password =  $configuracion["password"];

if(isset($_GET["id_seccion"])) {
    $connect = mysqli_connect($servername, $username, $password, $dbname);
    $query = 'SELECT N.titulo, DATE_FORMAT(N.fecha_publicacion, "%d/%m/%Y") as fecha_publicacion, U.descripcion as ubicacion, US.nombre, US.apellido, N.id_noticia, I.name_file, N.id_usuario FROM NOTICIA N
                JOIN UBICACION U ON N.id_ubicacion = U.id_ubicacion  
                JOIN USUARIO US ON N.id_usuario = US.id_usuario 
                JOIN IMAGEN I ON N.id_noticia = I.id_noticia
                WHERE id_seccion =' . $_GET["id_seccion"] . " AND id_estado = 1
                ORDER BY N.fecha_publicacion DESC" ;
    $result = mysqli_query($connect, $query);
    $resultado =  mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($resultado);
}