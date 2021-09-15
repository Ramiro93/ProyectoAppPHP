<?php
if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["rol"] == 'admin')) {
    $usuario_id = $_SESSION["usuario"]["id_usuario"];
} else {
    header("Location: index.php");
    exit();
}
?>

<h1 class="display-3 font-logo text-center mb-4">Notipip!</h1>

<div class="row mt-2">
    <div class="col-sm-4">
        <h2 class="display-4 font-content">Reporte Noticias activas</h2>
        <div class="d-flex justify-content-start flex-wrap">
        <a class="btn btn-primary" href="index.php?page=generarNoticiasPDF" target="_blank">Generar PDF</a>
        </div>
    </div>
    <div class="col-sm-4">
        <h2 class="display-4 font-content">Reporte Contenidistas</h2>
        <div class="d-flex justify-content-start flex-wrap">
        <a class="btn btn-primary" href="index.php?page=generarContenidistasPDF" target="_blank">Generar PDF</a>
        </div>
    </div>
    <div class="col-sm-4">
        <h2 class="display-4 font-content">Reporte Lectores suscriptos</h2>
        <div class="d-flex justify-content-start flex-wrap">
        <a class="btn btn-primary" href="index.php?page=generarLectoresPDF" target="_blank">Generar PDF</a>
        </div>
    </div>
</div>

    <button type="button" class="btn btn-secondary mt-5"><a href="index.php" class="text-light">Volver</a></button>
