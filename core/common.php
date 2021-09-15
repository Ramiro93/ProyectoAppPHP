<?php


if(isset($_GET["function"])) {
    $function = $_GET["function"];
    $function();
}

function cerrarSesion() {
    session_start();
    session_destroy();
    header("Location: ../index.php");
    exit;
}