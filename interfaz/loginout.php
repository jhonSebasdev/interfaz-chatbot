<?php


    // Iniciar la sesión
    session_start();

    // Eliminar todas las variables de sesión
    session_unset();

    // Destruir la sesión
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión o inicio
    header("Location: login.php"); // Cambia "login.php" por la página a la que quieras redirigir
    exit();



?>