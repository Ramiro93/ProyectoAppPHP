<?php

class NoticiaController{

    public function __construct(){

        include_once ("model/NoticiaModel.php");
    }

    public function crear($titulo, $descripcion, $seccion, $id_usuario, $ubicacion, $fecha_publicacion, $id_publicacion, $imagen){
        $modelo = new NoticiaModel();
        try{
            $row = $modelo->crear($titulo, $descripcion, $seccion, $id_usuario, $ubicacion, $fecha_publicacion);
            $id_noticia = $row[0]["id"];
            if(isset($imagen)) {
                $target_dir = "images/";
                $type = strtolower(pathinfo($imagen["name"],PATHINFO_EXTENSION));
                $target_file = $target_dir . "img_noticia_" . $id_noticia . "." . $type;
                $uploadOk = true;

                if($type != "jpg" && $type != "png") {
                    echo "Lo siento, solo se permiten imagenes jpg o png.";
                    $uploadOk = false;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                  echo "Lo siento, ya existe una imagen con este nombre, elija otro.";
                  $uploadOk = false;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                  echo "Lo siento, la imagen es demasiado grande.";
                  $uploadOk = false;
                }

                if ($uploadOk) {
                    if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
                        echo "La imagen " . "img_noticia_" . $id_noticia . "." . $type . " se cargo correctamente!";
                        $modelo->setImagen($id_noticia, $target_file);
                        header("Location:index.php?page=verNoticia&id_noticia=".$id_noticia);
                        exit();
                    } else {
                        echo "Lo siento, la imagen no se pudo cargar.";
                        header("Location:index.php?page=generarNoticia&idPublicacion=".$id_publicacion);
                        exit();
                    }

                }else{
                    $modelo->eliminar($id_noticia);
                    echo "La noticia no pudo ser creada.";
                    header("Location:index.php?page=generarNoticia&idPublicacion=".$id_publicacion);
                    exit();
                }

            }
        }catch(Exception $e){
            echo "No se pudo crear la noticia";
        }
        return $id_noticia;
    }

    public function obtenerNoticiasPorIdPublicacion($id_publicacion){
        $modelo = new NoticiaModel();
        $row = $modelo->obtenerNoticiasPorIdPublicacion($id_publicacion);
        return $row;
    }

    public function obtenerNoticias() {
        $modelo = new NoticiaModel();
        $row = $modelo->obtenerNoticias();
        return $row;
    }

    public function getById($id_noticia){
        $modelo = new NoticiaModel();
        $row = $modelo->getById($id_noticia);
        return $row;
    }

    public function updateNoticia($titulo, $descripcion, $seccion, $ubicacion, $fecha_publicacion, $id_noticia){

        $modelo = new NoticiaModel();
        try{
            $modelo->updateNoticia($titulo, $descripcion, $seccion, $ubicacion, $fecha_publicacion, $id_noticia);
        }catch(Exception $e){

            echo "no se pudo actualizar la noticia.";

        }
        

    }

}