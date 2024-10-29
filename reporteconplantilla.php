<?php
//ob_start(); // Iniciar el buffer de salida

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

// Incluye TCPDF
require_once(__DIR__ . '/vendor/tecnickcom/tcpdf/tcpdf.php');
require __DIR__ . "/config/config.php";

// Parámetros
$customerId = 3;

// Consulta SQL
$sql = "SELECT * FROM Customer WHERE custId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

// Recorrer los resultados y asignar a variables
while ($row = $result->fetch_assoc()) {
    $companyName = $row['companyName'];
    $contactName = $row['contactName'];
    $phone = $row['phone'];
    $address = $row['address'];
}

// Crear un nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetAuthor('ITCA-FEPADE');
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 9);

// Agregar una página
$pdf->AddPage();

// Obtener la plantilla HTML e insertar datos
$html = file_get_contents('plantilla.html');
$html = str_replace("{companyName}", $companyName, $html);
$html = str_replace("{contactName}", $contactName, $html);
$html = str_replace("{phone}", $phone, $html);
$html = str_replace("{address}", $address, $html);

// Insertar el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF y enviarlo al navegador
$pdf->Output('cliente.pdf', 'I');

// Cerrar la conexión y limpiar el buffer de salida
$conn->close();

?>
