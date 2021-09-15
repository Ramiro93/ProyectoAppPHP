<?php

class ReporteController{

    public function __construct(){
        include_once("model/ReporteModel.php");
    }

    public function obtenerContenidistasReporte(){
        $modelo = new ReporteModel();
        $contenidistas = $modelo->obtenerContenidistasReporte();
        include_once("pdf/pdfContenidistas.php");
        $pdf = new PDF();
        $pdf->crear($contenidistas);
    }
    
    public function obtenerLectoresReporte(){
        $modelo = new ReporteModel();
        $lectores = $modelo->obtenerLectoresReporte();
        include_once("pdf/pdfLectores.php");
        $pdf = new PDF();
        $pdf->crear($lectores);
    }

    public function obtenerNoticiasReporte(){
        $modelo = new ReporteModel();
        $noticias = $modelo->obtenerNoticiasReporte();
        include_once("pdf/pdfNoticias.php");
        $pdf = new PDF();
        $pdf->crear($noticias);
    }
}