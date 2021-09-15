<?php
session_start();
include_once("view/partial/header.php");
include_once("core/common.php");

$page = isset($_GET["page"]) ? $_GET["page"] : "";

switch ($page) {
    case "login":
        if (isset($_POST["email"])) {
            include_once("controller/CuentaController.php");
            $controller = new CuentaController();
            $controller->login($_POST["email"], $_POST["password"]);
        } else {
            include_once("view/loginView.php");
        }
        break;

    case "registrar":
        if (isset($_POST["email"])) {
            include_once("controller/CuentaController.php");
            $controller = new CuentaController();
            $controller->registrar(
                $_POST["email"],
                $_POST["password"],
                $_POST["nombre"],
                $_POST["apellido"],
                $_POST["rol"]
            );
        } else {
            include_once("view/registrarView.php");
        }
        break;

    case "generarPublicacion":
        include_once("controller/PublicacionController.php");
        $controller = new PublicacionController();

        if (isset($_POST["nombre"])) {
            $controller->crear(
                $_POST["nombre"],
                $_POST["descripcion"],
                $_POST["id_usuario"],
                $_POST["id_tipo_publicacion"],
                $_POST["precio"]
            );

            header("Location:index.php?page=mostrarPublicaciones");
            exit();
        } else {
            $tipos_publicacion = $controller->obtenerTiposPublicacion();
            include_once("view/formPublicacionView.php");
        }
        break;

    case "mostrarPublicaciones":
        include_once("controller/PublicacionController.php");
        $controller = new PublicacionController();
        $publicaciones = $controller->obtenerPublicaciones();

        include_once("view/publicacionesView.php");
        break;

    case "generarSeccion":
        if (isset($_POST["descripcion"])) {
            include_once("controller/SeccionController.php");
            $controller = new SeccionController();
            $controller->crear($_POST["descripcion"], $_POST["idPublicacion"]);
        }

        include_once("view/formSeccionView.php");
        break;

    case "generarNoticia":
        if (isset($_POST["titulo"])) {
            if($_FILES["imagen"]["size"] != 0) {
                include_once("controller/NoticiaController.php");
                $controller = new NoticiaController();
                $id_noticia = $controller->crear(
                    $_POST["titulo"],
                    $_POST["descripcion"],
                    $_POST["seccion"],
                    $_POST["id_usuario"],
                    $_POST["ubicacion"],
                    $_POST["fecha_publicacion"],
                    $_POST["id_publicacion"],
                    $_FILES["imagen"]
                );
            } else {
                echo "Seleccione una imagen!";
                $_GET["idPublicacion"] = $_POST["id_publicacion"];
            }
        }
        include_once("controller/UbicacionController.php");
        $controller = new UbicacionController();
        $ubicaciones = $controller->obtenerUbicaciones();
        include_once("controller/SeccionController.php");
        $controllerSeccion = new SeccionController();
        $secciones = $controllerSeccion->buscarSeccionesPorIdPublicacion($_GET["idPublicacion"]);
        include_once("view/formNoticiaView.php");

        break;

    case "noticias":
        include_once("controller/NoticiaController.php");
        $controller = new NoticiaController();
        $noticias = $controller->obtenerNoticiasPorIdPublicacion($_GET["id_publicacion"]);
        include_once("controller/SeccionController.php");
        $controller = new SeccionController();
        $secciones = $controller->buscarSeccionesPorIdPublicacion($_GET["id_publicacion"]);
        if(count($secciones) == 0) {
            include_once("controller/PublicacionController.php");
            $controller = new PublicacionController();
            $diarios = $controller->obtenerPublicacionesPorTipo("Diario");
            $revistas = $controller->obtenerPublicacionesPorTipo("Revista");

            if(isset($_SESSION["usuario"])) {
                include_once("controller/SuscripcionController.php");
                $controller = new SuscripcionController();
                $suscripciones = $controller->obtenerSuscripcionesByIdUsuario($_SESSION["usuario"]["id_usuario"]);
            }

            echo "<small class='text-danger'>En este momento, la publicación seleccionada no dispone de contenido.</small>";
            include_once("view/homeView.php");
        } else {
            include_once("view/noticiasView.php");
        }
        break;

    case "verNoticia":
        if(isset($_GET["id_noticia"])){
            include_once("controller/NoticiaController.php");
            $controller = new NoticiaController();
            $noticia = $controller->getById($_GET["id_noticia"])[0];
            include_once("controller/ComentarioController.php");
            $controller = new ComentarioController();
            $comentarios = $controller->obtenerComentariosByIdNoticia($_GET["id_noticia"]);

        }

        if(isset($_POST["comentario"])){
            include_once("controller/ComentarioController.php");
            $controller = new ComentarioController();
            $controller->insertarComentario($_POST["comentario"], $_POST["id_noticia"], $_SESSION["usuario"]["id_usuario"]);
            $comentarios = $controller->obtenerComentariosByIdNoticia($_POST["id_noticia"]);
            include_once("controller/NoticiaController.php");
            $controller = new NoticiaController();
            $noticia = $controller->getById($_POST["id_noticia"])[0];
            include_once ("view/verNoticiaView.php");
        }

        include_once ("view/verNoticiaView.php");
        break;
    
    case "adminNoticias":
        include_once("controller/NoticiaController.php");
        $controller = new NoticiaController();
        $noticias = $controller->obtenerNoticias();
        include_once("view/adminNoticiasView.php");
        break;    

    case "editarNoticia":
        if(isset($_POST["titulo"])){
            include_once("controller/NoticiaController.php");
            $controller = new NoticiaController();
            $controller->updateNoticia(
                $_POST["titulo"],
                $_POST["descripcion"],
                $_POST["seccion"],
                $_POST["ubicacion"],
                $_POST["fecha_publicacion"],
                $_POST["id_noticia"],
            );
            header("Location:index.php?page=verNoticia&id_noticia=".$_POST["id_noticia"]);
            exit();
        }else{
            include_once("controller/NoticiaController.php");
            $controller = new NoticiaController();
            $noticia = $controller->getById($_GET["id_noticia"])[0];
            include_once("controller/SeccionController.php");
            $controller = new SeccionController();
            $secciones = $controller->buscarSeccionesPorIdPublicacion($_GET["id_publicacion"]);
            include_once("controller/UbicacionController.php");
            $controller = new UbicacionController();
            $ubicaciones = $controller->obtenerUbicaciones();
            include_once("view/formEditarNoticiaView.php");
        }
        break; 
    
    case "usuarios":
        include_once("controller/UsuarioController.php");
        $controller = new UsuarioController();
        
        if(isset($_POST["id_usuario"])){
            $controller->cambiarRol($_POST["id_usuario"], $_POST["contenidista"]);
        }
        
        $usuarios = $controller->mostrarUsuarios();
        include_once("view/usuariosView.php");
        break;

    case "generarSuscripcion":
        include_once ("controller/SuscripcionController.php");
        $controller = new SuscripcionController();

        if(isset($_POST["id_publicacion"])){
            $controller->generarSuscripcion($_POST["id_publicacion"], $_SESSION["usuario"]["id_usuario"], $_POST["precio"], $_POST["titulo"]);
        }

        header("Location:index.php?page=homeView");
        exit();
        break;

    case "reportes":
        include_once("view/reportesView.php");
        break;
        
    case "generarNoticiasPDF":
        include_once("controller/ReporteController.php");
        $controller = new ReporteController();
        $controller->obtenerNoticiasReporte();
        include_once("view/reportesView.php");
        break;

    case "generarContenidistasPDF":
        include_once("controller/ReporteController.php");
        $controller = new ReporteController();
        $controller->obtenerContenidistasReporte();
        include_once("view/reportesView.php");
        break;

    case "generarLectoresPDF":
        include_once("controller/ReporteController.php");
        $controller = new ReporteController();
        $controller->obtenerLectoresReporte();
        include_once("view/reportesView.php");
        break;

    default:
        include_once("controller/PublicacionController.php");
        $controller = new PublicacionController();
        $diarios = $controller->obtenerPublicacionesPorTipo("Diario");
        $revistas = $controller->obtenerPublicacionesPorTipo("Revista");

        if(isset($_SESSION["usuario"])) {
            include_once("controller/SuscripcionController.php");
            $controller = new SuscripcionController();
            $suscripciones = $controller->obtenerSuscripcionesByIdUsuario($_SESSION["usuario"]["id_usuario"]);
        }

        include_once("view/homeView.php");
        break;
}

include_once("view/partial/footer.php");
