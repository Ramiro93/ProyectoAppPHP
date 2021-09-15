<h1 class="display-4 mt-2">Registrarse</h1>
<form action="index.php?page=registrar" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nombre</label>
    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Apellido</label>
    <input type="text" name="apellido" class="form-control" placeholder="Apellido">
  </div>
  <div class="form-group">
    <input type="hidden" name="rol" class="form-control" value="lector">
  </div>
  <!--<div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>-->
  <a href="index.php" class="text-light btn btn-secondary mt-2">Volver</a>
      <button type="submit" class="btn btn-primary mt-2">Registrarme</button>

</form>
