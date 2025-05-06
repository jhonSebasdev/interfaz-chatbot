<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Conexión e instancias
include_once '../core/db.php';
include_once '../Connection/exec_sql.php';
include_once '../core/controller_sql.php';

$datos_sql = new datos_sql();

// Obtener y sanitizar ID por GET
$id = isset($_GET['id']) ? htmlspecialchars(trim($_GET['id'])) : null;

if ($id) {
    //  Traer datos del nivel 2
    $resultado = $datos_sql->obtener_contenido_nivel2($id);

    // Verificar contenido
    if ($resultado && count($resultado) > 0) {
        foreach ($resultado as $fila) {
            echo "<div class='chatbox__body__message chatbox__body__message--left chat-bubble'>
                    <p>" . htmlspecialchars($fila['texto']) . "</p>
                  </div>";
        }
    } else {
        echo "<div class='chatbox__body__message chatbox__body__message--left chat-bubble'>
                <p style='color:red;'>No se encontró contenido para este botón de nivel 1.</p>
              </div>";
    }
} else {
    echo "<div class='chatbox__body__message chatbox__body__message--left chat-bubble'>
            <p style='color:red;'>No se recibió un ID válido.</p>
          </div>";
}
?>
