<?php

//Iniciamos la sesión
session_start();

//Evitamos que nos salgan los NOTICES de PHP
error_reporting(E_ALL ^ E_NOTICE);

$ob = $_GET['ob'];
$op = $_GET['op'];

//Comprobamos si la sesión está iniciada
//Si existe una sesión correcta, mostramos la página para los usuarios
//Sino, mostramos la página de acceso y registro de usuarios
if (isset($_SESSION['user']) == null) {
    header('Location: ../html/admin/status.html');
    die();
} else {
    switch ($ob) {
        case "user":
            switch ($op) {
                case "login":
                    require '../service/user.php';
                    break;
                case "logout":
                    require '../service/user.php';
                    break;
            }
            break;
    }
    die();
};
?>
    

