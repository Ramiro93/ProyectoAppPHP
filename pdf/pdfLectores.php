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
        $this->Cell(70,10,'Reporte Lectores Suscriptos',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(60,10,'Nombre',1,0,'C',0);
        $this->Cell(60,10,'Apellido',1,0,'C',0);
        $this->Cell(70,10,'Email',1,1,'C',0);

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

    function crear($lectores) {
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont('Times','',12);

        foreach($lectores as $row){
            $this->Cell(60,10,$row['Nombre'],1,0,'C',0);
            $this->Cell(60,10,$row['Apellido'],1,0,'C',0);
            $this->Cell(70,10,$row['Email'],1,1,'C',0);
        }

        ob_end_clean();
        $this->Output("reporteLectores.pdf", "I");
    }
}