<?php

if (isset($_GET['id'])) {
    get_persons($_GET['id']);
} else {
    die("Solicitud no válida.");
}

function get_persons($id) {

    //Cambia por los detalles de tu base datos
    $hostname = "localhost";
    $username = "root";
    $password = "bitnami";
    $dbname = "fanlist";

    $dB = new mysqli($hostname, $username, $password, $dbname);

    if ($dB === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $jsondata = array();

    //Sanitize ipnut y preparar query
    if (is_array($id)) {
        $id = array_map('intval', $id);
        $querywhere = "WHERE `id` IN (" . implode(' , ', $id) . ")";
    } else {
        $id = intval($id);
        $querywhere = "WHERE `id` = " . $id;
    }

    if ($result = $dB->query("SELECT * FROM `user` " . $querywhere)) {

        if ($result->num_rows > 0) {

            $jsondata["success"] = true;
            $jsondata["data"]["message"] = sprintf("Se han encontrado %d usuarios", $result->num_rows);
            $jsondata["data"]["users"] = array();
            while ($row = $result->fetch_object()) {
                //$jsondata["data"]["users"][] es un array no asociativo. Tendremos que utilizar JSON_FORCE_OBJECT en json_enconde
                //si no queremos recibir un array en lugar de un objeto JSON en la respuesta
                //ver http://www.php.net/manual/es/function.json-encode.php para más info
                $jsondata["data"]["users"][] = $row;
            }
        } else {

            $jsondata["success"] = false;
            $jsondata["data"] = array(
                'message' => 'No se encontró ningún resultado.'
            );
        }

        $result->close();
    } else {

        $jsondata["success"] = false;
        $jsondata["data"] = array(
            'message' => $dB->error
        );
    }

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);

    $dB->close();
}

exit();