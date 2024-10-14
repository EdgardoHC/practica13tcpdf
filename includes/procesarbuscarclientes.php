<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//REQUERIR LA CONEXION A LA BASE DE DATOS
    require "../config/config.php";

//Declaración de variables:
    $valid = true;
    $fechaInicial = $fechaFinal = $country = "";
//Fecha que se requiere para indicar la fecha en la que se fijó la contraseña o el cambio de contraseña
//HACER TRIM AL POST
    $_POST = array_map('trim', $_POST); //OK

    if (empty($_POST["pais"])) {
        $valid = false;
        echo 'Se esperaba valor';
    } else {
        $country = $_POST["pais"];
    }

    if ($valid) {
        //Prepara la consulta para obtener el nombre que viene del post:
        $stmt = $conn->prepare("SELECT * FROM customer
               WHERE country =  ?");

        $stmt->bind_param("s", $country);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $finaldata = [];
            if ($result->num_rows > 0) {
                // output data of each row
//                while ($value = $result->fetch_assoc()) {
//                    $companyName = $value["companyName"];
//                }
            }
            // Associative array
            $row = $result->fetch_all(MYSQLI_ASSOC);
            $finaldata = [
                'datos' => $row
            ];
        } else {
//                 echo "Hubo un error al ejecutar la consulta";
            echo "Hubo un error al ejecutar la consulta (" . $conn->errno . ") " . $conn->error . "<br>";
        }
        /* cerrar sentencia */
        $stmt->close();

        /* cerrar la conexión */
        $conn->close();
    }

//-----------------------------------------------------------------------------

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($finaldata);
}