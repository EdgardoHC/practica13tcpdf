<?php
// error_reporting(E_ALL);
//ini_set('display_errors', 'On');
// Incluye TCPDF
require_once( __DIR__ . '/vendor/tecnickcom//tcpdf/tcpdf.php');

// Crea una instancia de TCPDF
$pdf = new TCPDF();

// Añade una página
$pdf->AddPage();

// Establece el contenido
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, '¡Hola, este es un PDF generado con TCPDF!');

// Salida del PDF (descargar)
$pdf->Output('archivo.pdf', 'I');
