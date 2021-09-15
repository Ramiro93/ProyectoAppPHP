<?php
if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["rol"] == 'admin')) {
    $usuario_id = $_SESSION["usuario"]["id_usuario"];
} else {
    header("Location: index.php");
    exit();
}
?>

<h1 class="display-4 mt-2">Administración de noticias</h1>
<table class="table text-center">
    <tr>
        <th>Titulo</th>
        <th>Contenidista</th>
        <th>Seccion</th>
        <th>Publicación</th>
        <th>Fecha</th>
        <th></th>
    </tr>

        <?php
            foreach ($noticias as $noticia){
                $estado = ($noticia["id_estado"] == 1) ? "checked" : "";
                echo '<tr><td>' . $noticia["titulo"] . '</td>';
                echo '<td>' . $noticia["apellido"] .' '. $noticia["nombre"]. '</td>';
                echo '<td>' . $noticia["seccion"] . '</td>';
                echo '<td>' . $noticia["publicacion"] . '</td>';
                echo '<td>' . $noticia["fecha_creacion"] . '</td>';
                echo '<td>';
                echo '<div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" name="noticia_'. $noticia["id_noticia"] .'"' . $estado . ' 
                          onchange="changeEstado('. $noticia["id_noticia"] .')">
                          <label class="form-check-label">Publicado</label>
                        </div>';
                echo '</td>';

            }   
        ?>
    </table>
    
    <button type="button" class="btn btn-secondary mt-2"><a href="index.php" class="text-light">Volver</a></button>
</form>

<script>
    function changeEstado(noticia_id) {
        const noticia_estado = document.getElementsByName("noticia_"+noticia_id)[0].checked;
        console.log(noticia_estado);
        const xmlhttp=new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                alert("El estado se modifico correctamente!")
            }
        }
        xmlhttp.open("GET","ajax/adminNoticiasAjax.php?id_noticia="+noticia_id+"&estado="+noticia_estado,true);
        xmlhttp.send();
    }
</script>

