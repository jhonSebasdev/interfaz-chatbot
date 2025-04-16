<?php
// Proceso de inserción solo si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "cooperativas");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener datos del formulario
    $submenu_padre = trim($_POST['submenu_padre']); // del botón anterior (nivel 1 o 2)
    $nombre = trim($_POST['nombre_boton']);
    $texto = trim($_POST['texto_chatbot']);
    $estado = 1;

    // Generar claves automáticas
    $clave = strtolower(str_replace(' ', '_', $nombre));
    $imagen = '../images/logo.png';
    $href = 'submt_' . $clave;
    $onclick = 'onclick_' . $clave;
    $submenu = 'menu_' . $clave;

    // Insertar en la tabla nivel2
    $sql = "INSERT INTO nivel2 (submenu_padre, nombre, imagen, texto, href, estado, onclick, submenu)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssiss", $submenu_padre, $nombre, $imagen, $texto, $href, $estado, $onclick, $submenu);

    if ($stmt->execute()) {
        echo "<script>
            alert(' Botón del Nivel 2 insertado correctamente');
            if (window.opener) {
                window.opener.location.href = 'gestionMenu.php';
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


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear botón de chatbot - Nivel 2</title>
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
    </style>
</head>
<body>

<div class="form-container">
    <h3 class="form-title">🛠️ Crear nuevo botón para el chatbot (Nivel 2)</h3>

    <form method="POST" action="insertar_nivel2.php">
        <!-- Submenu del botón padre, enviado por GET en la URL -->
        <input type="hidden" name="submenu_padre" value="<?php echo isset($_GET['submenu']) ? htmlspecialchars($_GET['submenu']) : ''; ?>">

        <div class="mb-3">
            <label for="nombre_boton" class="form-label"><b>Nombre del botón</b></label>
            <input type="text" class="form-control" id="nombre_boton" name="nombre_boton"
                   placeholder="Ej: Ver detalles, Submenú..." required>
        </div>

        <div class="mb-3">
            <label for="texto_chatbot" class="form-label"><b>Texto para el chatbot</b></label>
            <textarea class="form-control" id="texto_chatbot" name="texto_chatbot" rows="4"
                      placeholder="Escriba el contenido que se mostrará en Nivel 2..." required></textarea>
        </div>

        <div class="form-check form-switch mb-3 d-flex justify-content-between align-items-center">
            <label class="form-check-label" for="estado"><b>Estado del botón</b></label>
            <input class="form-check-input" type="checkbox" id="estado" name="estado" value="1" checked>
            <span id="estado-label" class="ms-2 text-success">Activo</span>
        </div>

        <button type="submit" class="btn btn-purple w-100 mt-3">Guardar botón</button>
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
