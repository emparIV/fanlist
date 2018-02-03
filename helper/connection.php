<?php

require ("../config/database.php");

$mysqli = new mysqli($hostname, $username, $password, $dbname);

function checkConnection($mysqli) {
    if ($mysqli === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    echo "Connect Successfully. Host info: " . mysqli_get_host_info($mysqli);
}
