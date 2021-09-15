<!DOCTYPE html>
<html lang="en">
<title>Notipip!</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Oswald:wght@200;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<body>

<header>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand font-logo" href="index.php">Notipip!</a>


        <ul class="navbar-brand list-unstyled d-flex m-0">
            <?php
                if(isset($_SESSION["usuario"])) {
                    if($_SESSION["usuario"]["rol"] == "admin") {
                        echo '<li class="nav-item mr-2">
                                <a class="nav-link" href="index.php?page=reportes">Reportes</a>
                            </li>';
                        echo '<li class="nav-item mr-2">
                                <a class="nav-link" href="index.php?page=adminNoticias">Administrar Noticias</a>
                            </li>';
                        echo '<li class="nav-item mr-2">
                            <a class="nav-link" href="index.php?page=usuarios">Administrar Usuarios</a>
                        </li>';
                    } else if($_SESSION["usuario"]["rol"] == "contenidista") {
                        echo '<li class="nav-item mr-2">
                            <a class="nav-link" href="index.php?page=mostrarPublicaciones">Crear contenido</a>
                        </li>';
                    }
                    echo '<li class="nav-item d-flex align-items-center flex-column">
                                <i class="fa fa-user-circle" style="font-size: larger;"></i>
                                <small class="text-black">'. $_SESSION["usuario"]["nombre"] .'</small>
                            </li>';
                    echo '<a class="badge p-0 text-secondary d-flex" href="core/common.php?function=cerrarSesion" title="Cerrar sesion" style="font-size: medium;">
                                <i class="fa fa-times-circle"></i>
                            </a>';
                } else {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Login</a>
                        </li>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="index.php?page=registrar">Registrarse</a>
                        </li>';
                }
            ?>
        </ul>
    </nav>
</header>

<!-- Page content -->
<div class="container p-3 mt-2">