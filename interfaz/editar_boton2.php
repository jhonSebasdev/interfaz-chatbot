<?php
$conexion = new mysqli("localhost", "root", "", "cooperativas");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$submenu = $_GET['submenu'] ?? '';
$tabla = (strpos($submenu, 'menu_') === 0) ? 'menu' : 'nivel2';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre_boton']);
    $texto = trim($_POST['texto_chatbot']);
    $estado = isset($_POST['estado']) && $_POST['estado'] == '1' ? 1 : 0;

    if (isset($_POST['eliminar'])) {
        $stmt = $conexion->prepare("DELETE FROM $tabla WHERE submenu = ?");
        $stmt->bind_param("s", $submenu);
        $stmt->execute();
        $stmt->close();

        echo "<script>
            alert('Botón eliminado correctamente');
            if (window.opener) {
                window.opener.location.href = 'gestionMenu.php';
                window.close();
            }
        </script>";
    } else {
        $stmt = $conexion->prepare("UPDATE $tabla SET nombre = ?, texto = ?, estado = ? WHERE submenu = ?");
        $stmt->bind_param("ssis", $nombre, $texto, $estado, $submenu);
        $stmt->execute();
        $stmt->close();

        echo "<script>
            alert('Botón actualizado correctamente');
            if (window.opener) {
                window.opener.location.href = 'gestionMenu.php';
                window.close();
            }
        </script>";
    }
}

$stmt = $conexion->prepare("SELECT * FROM $tabla WHERE submenu = ?");
$stmt->bind_param("s", $submenu);
$stmt->execute();
$result = $stmt->get_result();
$boton = $result->fetch_assoc();
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar botón de chatbot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-purple {
            background-color: #6f42c1;
            color: white;
        }
        .btn-red {
            background-color: #dc3545;
            color: white;
        }
    </style>

    <!-- TinyMCE LOCAL -->
    <script src="../tinymce_7.8.0/tinymce/tinymce.min.js"></script>
</head>
<body>
<div class="form-container">
    <h3 class="form-title">✏️ Editar o eliminar botón del chatbot</h3>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre_boton" class="form-label"><b>Nombre del botón</b></label>
            <input type="text" class="form-control" id="nombre_boton" name="nombre_boton"
                   value="<?= htmlspecialchars($boton['nombre'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="texto_chatbot" class="form-label"><b>Texto para el chatbot</b></label>
            <textarea class="form-control" id="texto_chatbot" name="texto_chatbot" rows="4" required><?= htmlspecialchars($boton['texto'] ?? '') ?></textarea>
        </div>

        <div class="form-check form-switch mb-3 d-flex justify-content-between align-items-center">
            <label class="form-check-label" for="estado"><b>Estado del botón</b></label>
            <input class="form-check-input" type="checkbox" id="estado" name="estado" value="1"
                <?= ($boton['estado'] ?? 0) == 1 ? 'checked' : '' ?>>
            <span id="estado-label" class="ms-2 <?= ($boton['estado'] ?? 0) == 1 ? 'text-success' : 'text-danger' ?>">
                <?= ($boton['estado'] ?? 0) == 1 ? 'Activo' : 'Inactivo' ?>
            </span>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" name="eliminar" class="btn btn-red">🗑️ Eliminar</button>
            <button type="submit" class="btn btn-purple">💾 Guardar</button>
        </div>
    </form>
</div>

<!-- TinyMCE config -->
<script>
tinymce.init({
    selector: 'textarea[name="texto_chatbot"]',
    height: 300,
    plugins: 'emoticons advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons charmap | forecolor backcolor | code fullscreen',
    menubar: true,
    language: 'es',
    emoticons_append: {
        custom_mono: [
            { title: 'Cool', char: '😎' },
            { title: 'Fire', char: '🔥' },
            { title: 'Idea', char: '💡' },
            { title: 'Success', char: '✅' }
        ]
    }
});

const estadoCheckbox = document.getElementById('estado');
const estadoLabel = document.getElementById('estado-label');

estadoCheckbox.addEventListener('change', function () {
    estadoLabel.textContent = this.checked ? "Activo" : "Inactivo";
    estadoLabel.className = "ms-2 " + (this.checked ? "text-success" : "text-danger");
});
</script>
</body>
</html>
