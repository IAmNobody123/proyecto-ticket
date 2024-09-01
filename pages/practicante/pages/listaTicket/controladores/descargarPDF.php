<?php
include "../../../../../controlador/fpdf186/fpdf.php";

// Verifica si se han enviado datos por GET
if (isset($_GET['idTicket'])) {
    class PDF extends FPDF
    {
        function header()
        {
            $this->SetFont('Times', 'B', 20);
            $this->Image('../../../img/inka.png', 20, 0, 180);
            $this->setXY(10, 50);

        }
    }
    // Captura los datos enviados desde la URL
    $idTicket = $_GET['idTicket'];
    $nombreS = $_GET['nombreS'];
    $fecha = $_GET['fecha'];
    $hora = $_GET['hora'];
    $nombre = $_GET['nombre'];
    $nombreOficina = $_GET['oficina'];
    $descripcionProblema = $_GET['descripcionProblema'];

    // Crea una nueva instancia de FPDF
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Times', 'B', 16);

    // Agrega contenido al PDF
    $pdf->Cell(190, 10, '                            SOLICITUD SOPORTE NRO: ' . $idTicket, 1, 1, 'C');
    $pdf->Cell(40, 10, 'Solicitante', 1, 0, 'C');
    $pdf->setX(50);
    $pdf->Cell(150, 10, '       ' . $nombreS, 1, 1, 'C');
    $pdf->Cell(40, 10, 'Area', 1, 0, 'C');
    $pdf->setX(50);
    $pdf->Cell(150, 10, '       ' . $nombreOficina, 1, 1, 'C');
    $pdf->setX(10);

    $pdf->Cell(40, 10, '        Fecha ', 1, 0);
    $pdf->Cell(30, 10, $fecha, 1, 0);
    $pdf->Cell(20, 10, '  Hora ', 1, 0);
    $pdf->Cell(30, 10, $hora, 1, 0);
    $pdf->Cell(36, 10, '  Satisfaccion ', 1, 0);
    $pdf->Cell(17, 10, ' SI ', 1, 0);
    $pdf->Cell(17, 10, '  NO ', 1, 1);

    $pdf->Cell(40, 10, ' Requerimiento ', 1, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(30, 10, 'HARDWARE', 1, 0);
    $pdf->Cell(30, 10, 'SOFTWARE', 1, 0);
    $pdf->Cell(30, 10, 'INTERNET', 1, 0);
    $pdf->Cell(30, 10, 'PERIFERICOS', 1, 0);
    $pdf->Cell(30, 10, 'CONEXIONES', 1, 1);
    $pdf->SetFont('Times', 'B', 16);

    $x = $pdf->GetX(); // Obtiene la posición actual en X
    $y = $pdf->GetY(); // Obtiene la posición actual en Y
    $pdf->MultiCell(40, 20, 'Descripcion de la solucion', 1, 'C', 0);
    $pdf->SetXY($x + 40, $y);
    $pdf->Cell(150, 40, '', 1, 1);

    $pdf->Cell(40, 10, '  Atendido por ', 1, 0);
    $pdf->Cell(150, 10, $nombre, 1, 1, 'C');


    
    $pdf->Cell(190, 30, '  ', 1, 1);

    $pdf->SetXY($pdf->GetX() + 25, $pdf->GetY() -10);
    $pdf->MultiCell(80, 0, "________________", 0, 'L');

    $pdf->SetXY($pdf->GetX() + 120, $pdf->GetY() );
    $pdf->MultiCell(80, 0, "________________", 0, 'L');

    $pdf->SetXY($pdf->GetX() - 180, $pdf->GetY()+7);
    $pdf->MultiCell(80, 0, "Firma interesado", 0, 'L');

    $pdf->SetXY($pdf->GetX() + 105, $pdf->GetY());
    $pdf->MultiCell(120, 0, "Firma del encargado del soporte", 0, 'L');


    // Muestra el PDF en el navegador
    $pdf->Output('I', 'ticket_' . $idTicket . '.pdf'); // 'I' para mostrar en el navegador
} else {
    echo "No se han enviado datos.";
}
?>