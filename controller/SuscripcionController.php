<?php


class SuscripcionController{

    public function __construct(){
        include_once("model/SuscripcionModel.php");
    }

    public function generarSuscripcion($id_publicacion, $id_usuario, $precio, $titulo){
        $modelo = new SuscripcionModel();
        try{
            $modelo->generarSuscripcion($id_publicacion, $id_usuario, $precio, $titulo);
            include_once("pdf/pdfFactura.php");
            $pdf = new PDF();
            $factura = array("titulo" => $titulo,
                            "fecha" => date("d-m-Y"),
                            "precio" => $precio,
                            "usuario" => $_SESSION["usuario"]["nombre"]);
            $pdf->crear($factura);
        }catch(Exception $e){
            echo "No se pudo realizar la suscripción";
        }
    }

    public function obtenerSuscripcionesByIdUsuario($id_usuario){
        $modelo = new SuscripcionModel();
        $row = $modelo->obtenerSuscripcionesByIdUsuario($id_usuario);
        return $row;
    }

}