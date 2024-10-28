<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta y Generación de Reporte PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Generar Reporte de Órdenes por Cliente</h2>
        <form method="post" action="reporteordenes.php" target="_blank">
            <div class="form-group">
                <label for="fechaInicio">Fecha Inicio:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fechaFin">Fecha Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Generar PDF</button>
        </form>
    </div>
</body>
</html>
