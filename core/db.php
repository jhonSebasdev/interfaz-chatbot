<?php

/*Datos de conexion a la base de datos*/
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "cooperativas");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>