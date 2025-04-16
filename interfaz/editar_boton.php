<?php
$conexion = new mysqli("localhost", "root", "", "cooperativas");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$submenu = $_GET['submenu'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre_boton']);
    $texto = trim($_POST['texto_chatbot']);
    $estado = isset($_POST['estado']) && $_POST['estado'] == '1' ? 1 : 0;

    if (isset($_POST['eliminar'])) {
        $stmt = $conexion->prepare("DELETE FROM menu WHERE submenu = ?");
        $stmt->bind_param("s", $submenu);
        $stmt->execute();

        // Eliminar también de nivel 2 (opcional)
        $stmt2 = $conexion->prepare("DELETE FROM nivel2 WHERE submenu = ?");
        $stmt2->bind_param("s", $submenu);
        $stmt2->execute();
        $stmt2->close();

        echo "<script>
            alert('Botón eliminado correctamente');
            if (window.opener) {
                window.opener.location.href = 'gestionMenu.php';
                window.close();
            }
        </script>";
    } else {
        // Actualizar nivel 1
        $stmt = $conexion->prepare("UPDATE menu SET nombre = ?, texto = ?, estado = ? WHERE submenu = ?");
        $stmt->bind_param("ssis", $nombre, $texto, $estado, $submenu);
        $stmt->execute();
        $stmt->close();

        // 🔁 Sincronizar texto en nivel 2
        $stmt2 = $conexion->prepare("UPDATE nivel2 SET texto = ? WHERE submenu = ?");
        $stmt2->bind_param("ss", $texto, $submenu);
        $stmt2->execute();
        $stmt2->close();

        echo "<script>
            alert('Botón actualizado correctamente');
            if (window.opener) {
                window.opener.location.href = 'gestionMenu.php';
                window.close();
            }
        </script>";
    }
}

$stmt = $conexion->prepare("SELECT * FROM menu WHERE submenu = ?");
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
        .form-control {
            border-radius: 10px;
        }
        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border-radius: 10px;
        }
        .btn-purple:hover {
            background-color: #5a32a3;
        }
        .btn-red {
            background-color: #dc3545;
            color: white;
            border-radius: 10px;
        }
        .btn-red:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3 class="form-title">✏️ Editar o eliminar botón para el chatbot</h3>

    <form method="POST">
        <div class="mb-3">
            <label for="nombre_boton" class="form-label"><b>Nombre del botón</b></label>
            <input type="text" class="form-control" id="nombre_boton" name="nombre_boton"
                   value="<?php echo htmlspecialchars($boton['nombre']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="texto_chatbot" class="form-label"><b>Texto para el chatbot</b></label>
            <textarea class="form-control" id="texto_chatbot" name="texto_chatbot" rows="4" required><?php echo htmlspecialchars($boton['texto']); ?></textarea>
        </div>

        <!-- ✅ SWITCH DE ESTADO -->
        <div class="form-check form-switch mb-3 d-flex justify-content-between align-items-center">
            <label class="form-check-label" for="estado"><b>Estado del botón</b></label>
            <input class="form-check-input" type="checkbox" id="estado" name="estado" value="1"
                <?php echo ($boton['estado'] == 1) ? 'checked' : ''; ?>>
            <span id="estado-label" class="ms-2 <?php echo ($boton['estado'] == 1) ? 'text-success' : 'text-danger'; ?>">
                <?php echo ($boton['estado'] == 1) ? 'Activo' : 'Inactivo'; ?>
            </span>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" name="eliminar" class="btn btn-red">🗑️ Eliminar botón</button>
            <button type="submit" class="btn btn-purple">💾 Guardar cambios</button>
        </div>
    </form>
</div>

<script>
    const estadoCheckbox = document.getElementById('estado');
    const estadoLabel = document.getElementById('estado-label');

    estadoCheckbox.addEventListener('change', function () {
        if (this.checked) {
            this.value = "1";
            estadoLabel.textContent = "Activo";
            estadoLabel.classList.replace("text-danger", "text-success");
        } else {
            this.value = "0";
            estadoLabel.textContent = "Inactivo";
            estadoLabel.classList.replace("text-success", "text-danger");
        }
    });
</script>

</body>
</html>
