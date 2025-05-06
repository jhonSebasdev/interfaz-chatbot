<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Conexión
$conexion = new mysqli("localhost", "root", "", "cooperativas");
if ($conexion->connect_error) {
    die("<p style='color:red;'>Error de conexión: " . $conexion->connect_error . "</p>");
}

$id = isset($_GET['id']) ? trim($_GET['id']) : null;

if ($id) {
    // 1. Traer texto desde la tabla "menu" usando el ID recibido
    $stmtMenu = $conexion->prepare("SELECT texto FROM menu WHERE submenu = ?");
    $stmtMenu->bind_param("s", $id);
    $stmtMenu->execute();
    $resMenu = $stmtMenu->get_result();

    if ($resMenu && $resMenu->num_rows > 0) {
        $menuRow = $resMenu->fetch_assoc();
        $textoPregunta = $menuRow['texto'];

        // Mostrar la burbuja con el texto HTML del Nivel 1 (sin htmlspecialchars)
        echo '
        <div class="chatbox__body__message chatbox__body__message--left chat-bubble" id="pregunta_nivel2">
            <img src="../images/logo1.png" alt="logo nivel 2" class="chat-logo1">
            ' . $textoPregunta . '
        </div>';
    }

    $stmtMenu->close();

    // 2. Traer los botones hijos desde nivel2
    $stmtNivel2 = $conexion->prepare("SELECT * FROM nivel2 WHERE submenu_padre = ?");
    $stmtNivel2->bind_param("s", $id);
    $stmtNivel2->execute();
    $resNivel2 = $stmtNivel2->get_result();

    if ($resNivel2 && $resNivel2->num_rows > 0) {
        while ($fila = $resNivel2->fetch_assoc()) {
            if ($fila['tipo'] === 'boton') {
                echo '
                <div class="chatbox__body__message chatbox__body__message--left" style="display: flex; gap: 10px; margin-top: 10px;">
                    <a href="#' . $fila['submenu'] . '" class="btn botones" onClick="cargarNivel3(\'' . $fila['submenu'] . '\')" style="flex: 1;">' . $fila['texto'] . '</a>
                </div>';
            }
        }

        echo '
        <div class="chatbox__body__message chatbox__body__message--left text-center" style="margin-top: 20px;">
            <button onclick="regresarMenu()" style="
                background-color: #3b4cca;
                color: white;
                border: none;
                padding: 12px 28px;
                border-radius: 18px;
                font-size: 15px;
                font-weight: 500;
                display: inline-flex;
                align-items: center;
                gap: 12px;
                box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
            ">
                <img src="../images/logo1.png" alt="Bot" style="width: 35px; height: 35px; border-radius: 50%;">
                Regresar al menú principal
            </button>
        </div>';
    } else {
        echo "<p style='color:red;'>⚠️ No hay botones hijos para este botón del Nivel 1 (ID: $id).</p>";
    }

    $stmtNivel2->close();
} else {
    echo "<p style='color:red;'>ID no recibido correctamente.</p>";
}

$conexion->close();
