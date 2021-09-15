<?php
if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["rol"] == 'admin')) {
    $usuario_id = $_SESSION["usuario"]["id_usuario"];
} else {
    header("Location: index.php");
    exit();
}
?>

<h1 class="display-4 mt-2">Administración de usuarios</h1>

<table class="table text-center">
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th></th>
    </tr>

        <?php
            foreach ($usuarios as $usuario){
                $rol = ($usuario["id_rol"] == 2) ? "checked" : "";
                echo '<tr><td>' . $usuario["nombre"] . '</td>';
                echo '<td>' . $usuario["apellido"] . '</td>';
                echo '<td>';
                echo '<div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" name="contenidista_'. $usuario["id_usuario"] .'"' . $rol . ' 
                          onchange="changeRol('. $usuario["id_usuario"] .')">
                          <label class="form-check-label">Contenidista</label>
                        </div>';
                echo '</td>';

            }   
        ?>
    </table>
    <button type="button" class="btn btn-secondary mt-2"><a href="index.php" class="text-light">Volver</a></button>
</form>

<script>
    function changeRol(usuario_id) {
        const contenidista = document.getElementsByName("contenidista_"+usuario_id)[0].checked;
        console.log(contenidista);
        const xmlhttp=new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                alert("El usuario se modifico correctamente!")
            }
        }
        xmlhttp.open("GET","ajax/usuariosAjax.php?id_usuario="+usuario_id+"&contenidista="+contenidista,true);
        xmlhttp.send();
    }
</script>

