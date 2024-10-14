<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//REQUERIR LA CONEXION A LA BASE DE DATOS
    require "../config/config.php";

//Declaración de variables:
    $valid = true;

    if ($valid) {
        $sql = "SELECT COUNT(custId) conteo, country
FROM customer
GROUP BY country;
";
        //Prepara la consulta para obtener el nombre que viene del post:
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $finaldata = [];
            // Associative array
            $row = $result->fetch_all(MYSQLI_ASSOC);
           // var_dump($row);
            $finaldata = [
                'datos' => $row
            ];
        } else {
//                 echo "Hubo un error al ejecutar la consulta";
            echo "Hubo un error al ejecutar la consulta (" . $conn->errno . ") " . $conn->error . "<br>";
        }
        /* cerrar sentencia */
        $result->close();

        /* cerrar la conexión */
        $conn->close();
    }

//-----------------------------------------------------------------------------

   header('Content-type: application/json; charset=utf-8');
   echo json_encode($finaldata);
}