<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "cooperativas");
    if ($conexion->connect_error) {
        die("<p style='color:red;'>Error de conexión: " . $conexion->connect_error . "</p>");
    }

    $submenu_padre = trim($_POST['submenu_padre']);
    $nombre = trim($_POST['nombre_boton']);
    $texto = trim($_POST['texto_chatbot']);
    $estado = 1;
    $tipo = "boton";

    $clave = strtolower(str_replace(' ', '_', $nombre));
    $imagen = '../images/logo.png';
    $href = 'submt_' . $clave;
    $onclick = 'onclick_' . $clave;

    // Contar hijos existentes de ese submenu_padre
    $sqlCount = "SELECT COUNT(*) AS total FROM nivel2 WHERE submenu_padre = ?";
    $stmtCount = $conexion->prepare($sqlCount);
    $stmtCount->bind_param("s", $submenu_padre);
    $stmtCount->execute();
    $resultado = $stmtCount->get_result();
    $row = $resultado->fetch_assoc();
    $total_hijos = $row['total'];
    $stmtCount->close();

    $submenu = 'hijo_' . $submenu_padre . '_' . ($total_hijos + 1);

    // Insertar nuevo botón hijo
    $sql = "INSERT INTO nivel2 (
                submenu_padre, nombre, texto, tipo, imagen, href, onclick, submenu, estado
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssi", $submenu_padre, $nombre, $texto, $tipo, $imagen, $href, $onclick, $submenu, $estado);

    if ($stmt->execute()) {
        echo "<script>
            alert('Botón del Nivel 2 insertado correctamente como $submenu');
            if (window.opener) {
                window.opener.location.href = 'gestionMenu.php#{$submenu_padre}';
                window.close();
            }
        </script>";
        
    } else {
        echo "<div class='alert alert-danger text-center'>Error al insertar en Nivel 2: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conexion->close();
}
?>
