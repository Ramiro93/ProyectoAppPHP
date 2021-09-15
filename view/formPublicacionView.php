<?php
if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["rol"] == 'contenidista')) {
    $usuario_id = $_SESSION["usuario"]["id_usuario"];
} else {
    header("Location: index.php");
    exit();
}
?>

<h1 class="display-4">Crear publicación</h1>

<form action="index.php?page=generarPublicacion" method="POST">
  <div class="form-group">
    <label for="nombre">Nombre Publicacion</label>
    <input type="text" name="nombre" class="form-control" id="nombre">
  </div>
  
  <div class="form-group">
    <label for="descripcion">Descripcion</label>
    <textarea type="text" name="descripcion" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="tipo_publicacion">Tipo Publicacion</label>
    <select name="id_tipo_publicacion" id="id_tipo_publicacion" class="form-control">
      <option value="<?php echo $tipos_publicacion[0]["id_tipo_publicacion"]?>"><?php echo $tipos_publicacion[0]["descripcion"]?></option>
      <option value="<?php echo $tipos_publicacion[1]["id_tipo_publicacion"]?>"><?php echo $tipos_publicacion[1]["descripcion"]?></option>
    </select>
  </div>
  <div class="form-group">
    <label for="precio">Importe</label>
    <input type="number" name="precio" class="form-control" value="0">
  </div>
  <div class="form-group">
    <input type="hidden" value="<?php echo $usuario_id ?>" name="id_usuario" class="form-control">
  </div>

    <a href="index.php?page=mostrarPublicaciones" class="text-light btn btn-secondary">Volver</a>
  <button type="submit" class="btn btn-primary">Publicar</button>

</form>
