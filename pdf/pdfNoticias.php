<?php
require('pdf/fpdf.php');

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('view/img/logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,10,'Reportes Noticias Activas',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(45,10,'Titulo',1,0,'C',0);
        $this->Cell(45,10,'Fecha',1,0,'C',0);
        $this->Cell(50,10,'Seccion',1,0,'C',0);
        $this->Cell(50,10,'Contenidista',1,1,'C',0);
    }

    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function crear($noticias) {
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont('Times','',12);

        foreach($noticias as $row){
            $this->Cell(45,10,$row['Titulo'],1,0,'C',0);
            $this->Cell(45,10,$row['Fecha'],1,0,'C',0);
            $this->Cell(50,10,$row['Seccion'],1,0,'C',0);
            $this->Cell(50,10,$row['Contenidista'],1,1,'C',0);
        }

        ob_end_clean();
        $this->Output("reporteNoticias.pdf", "I");
    }
}