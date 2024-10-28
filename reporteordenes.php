<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


// Incluye TCPDF
require_once( __DIR__ . '/vendor/tecnickcom//tcpdf/tcpdf.php');

require __DIR__ . "/config/config.php";
// Obtener fechas del formulario
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
// Rango de fechas
//$fechaInicio = '1990-01-01';
//$fechaFin = '2024-12-31';

// Consulta SQL
$sql = "SELECT ord.custId, c.companyName, COUNT(ord.orderId) AS totalOrders, MIN(ord.orderDate) AS firstOrderDate, MAX(ord.orderDate) AS lastOrderDate
        FROM salesorder ord 
        INNER JOIN customer c ON ord.custId = c.custId
        WHERE ord.orderDate BETWEEN ? AND ?
        GROUP BY ord.custId
        ORDER BY totalOrders DESC";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $fechaInicio, $fechaFin);
$stmt->execute();
$result = $stmt->get_result();

// Crear un nuevo PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Reporte de Órdenes por Cliente');
$pdf->SetHeaderData('', 0, 'Reporte de Órdenes por Cliente', 'Generado automáticamente', array(0,64,255), array(0,64,128));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 25);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

// Generar el contenido HTML de la tabla
$html = '<h2>Reporte de Órdenes por Cliente</h2>';
$html .= '<table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre de la Compañía</th>
                    <th>Total Órdenes</th>
                    <th>Primera Fecha de Orden</th>
                    <th>Última Fecha de Orden</th>
                </tr>
            </thead>
            <tbody>';

// Recorrer los resultados y agregarlos a la tabla
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['custId'] . '</td>
                <td>' . $row['companyName'] . '</td>
                <td>' . $row['totalOrders'] . '</td>
                <td>' . $row['firstOrderDate'] . '</td>
                <td>' . $row['lastOrderDate'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';
//echo $html;
// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('reporte_ordenes_por_cliente.pdf', 'I');

// Cerrar la conexión
$conn->close();
}else{
    die("Por favor vuelva a generar el reporte");
}
?>
