<?php
if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["rol"] == 'contenidista')) {
    $usuario_id = $_SESSION["usuario"]["id_usuario"];
} else {
    header("Location: index.php");
    exit();
}
?>

<h1 class="display-4">Editar noticia</h1>

<form action="index.php?page=editarNoticia" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" value="<?php echo $usuario_id ?>" name="id_usuario" class="form-control">
        <input type="hidden" value="<?php echo $_GET["idPublicacion"] ?>" name="id_publicacion" class="form-control">
        <input type="hidden" value="<?php echo $_GET["id_noticia"] ?>" name="id_noticia" class="form-control">
    </div>
    <div class="form-group">
        <label for="seccion">Sección:</label>
        <select  name="seccion" id="seccion" class="form-control">
            <?php
            
            foreach ($secciones as $seccion) {
                
                echo '<option value="' . $seccion["id_seccion"].'"';
                if($seccion["id_seccion"] == $noticia["id_seccion"]){
                    echo 'selected';
                }
                echo '>' . $seccion["descripcion"] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="titulo">Titulo:</label>
        <input value="<?php echo $noticia["titulo"]?>" type="text" name="titulo" class="form-control">
    </div>

    <div class="form-group">
        <label for="fecha_publicacion">Fecha a publicar:</label>
        <input value="<?php echo $noticia["fecha_publicacion"]?>" type="date" name="fecha_publicacion" id="fecha_publicacion" class="form-control">
    </div>
    <div class="form-group">
        <label>Ubicación:</label>
        <select name="ubicacion" class="form-control">
            <?php
            foreach ($ubicaciones as $ubicacion) {
                echo '<option value="'.$ubicacion["id_ubicacion"].'"';

                if($ubicacion["id_ubicacion"] == $noticia["id_ubicacion"]){
                    echo 'selected';
                }
                
                echo '>'. $ubicacion["descripcion"] .'</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Imagen:</label>
        <img  src='<?php echo $noticia["name_file"] ?>' height='100px'>
    </div>

    <label>Contenido:</label>
    <textarea id="mytextarea" name="descripcion"><?php echo $noticia["contenido"] ?></textarea>

    <a href="index.php?page=mostrarPublicaciones" class="text-light btn btn-secondary mt-2">Volver</a>
    <button type="submit" class="btn btn-primary mt-2">Publicar</button>
</form>

<script src="https://cdn.tiny.cloud/1/yjse211jljxx06d0t3y7z688njdjdmb1y52ijbe63nx794vk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

    tinymce.init({
        selector: '#mytextarea'
    });
</script>