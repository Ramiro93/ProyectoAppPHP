<?php
    if(isset($_SESSION["usuario"])) {
        $usuario_id = $_SESSION["usuario"]["id_usuario"];
    } else {
        header("Location: index.php");
        exit();
    }
?>

<div>
    <a href="index.php" class="text-light btn btn-secondary mb-2">Volver</a>
    <a href="index.php?page=generarPublicacion" class="btn btn-primary pull-right mb-2">Crear nueva publicación</a>
</div>

<h1 class="display-4 mt-2">Publicaciones</h1>
<div class="d-flex justify-content-start flex-wrap">
    <?php
        foreach($publicaciones as $publicacion) {
            echo '<div class="card mr-3 mb-2" style="width: 45%;">
                      <!--<img class="card-img-top" src="..." alt="Card image cap">-->
                      <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title"> '. $publicacion["nombre"] .' </h5>
                            <p class="card-text"> '. $publicacion["descripcion"] .' </p>
                            <div class="row justify-content-around">
                                <a class="btn btn-primary col-4" href="index.php?page=generarNoticia&idPublicacion='
                                                . $publicacion["id_publicacion"] . '">Publicar Noticia</a>
                                <a class="btn btn-success col-4" href="index.php?page=generarSeccion&idPublicacion='
                                                . $publicacion["id_publicacion"] . '">Nueva Seccion</a>
                            </div>
                      </div>
            </div>';
    }

    ?>
</div>


