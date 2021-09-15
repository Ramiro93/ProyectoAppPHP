<?php
if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["rol"] == 'contenidista')) {
    $usuario_id = $_SESSION["usuario"]["id_usuario"];
} else {
    header("Location: index.php");
    exit();
}
?>

<h1 class="display-4 mt-2">Crear sección</h1>
<form action="index.php?page=generarSeccion" method="POST">
  <div class="form-group">
    <label for="descripcion">Nombre:</label>
    <input type="text" name="descripcion" class="form-control">
  </div>
  <div class="form-group">
    <input type="hidden" value="<?php echo $_GET["idPublicacion"] ?>" name="idPublicacion" class="form-control">
  </div>
  <a href="index.php?page=mostrarPublicaciones" class="text-light btn btn-secondary">Volver</a>
  <button type="submit" class="btn btn-primary">Crear</button>
</form>