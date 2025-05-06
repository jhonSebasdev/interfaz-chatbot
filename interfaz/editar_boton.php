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
    $url_destino = trim($_POST['url_destino'] ?? ''); 

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
        $stmt = $conexion->prepare("UPDATE $tabla SET nombre = ?, texto = ?, estado = ?, url_destino = ? WHERE submenu = ?");
        $stmt->bind_param("ssiss", $nombre, $texto, $estado, $url_destino, $submenu);
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
    <title>Editar botón</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://mannatthemes.com/unikit/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://mannatthemes.com/unikit/assets/css/icons.min.css" rel="stylesheet">
    <link href="https://mannatthemes.com/unikit/assets/css/app.min.css" rel="stylesheet">
    <script src="tinymce_7.8.0/tinymce.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">✏️ Editar botón del chatbot</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label"><b>Nombre del botón</b></label>
                            <input type="text" class="form-control" name="nombre_boton"
                                   value="<?= htmlspecialchars($boton['nombre'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Texto del chatbot</b></label>
                            <textarea class="form-control" name="texto_chatbot" rows="8"><?= htmlspecialchars($boton['texto'] ?? '') ?></textarea>
                        </div>

                        <!-- Nuevo campo de tipo de acción -->
                        <div class="mb-3">
                            <label class="form-label"><b>Tipo de acción</b></label>
                            <select class="form-select" id="tipoAccion" name="tipo_accion" onchange="mostrarInputLink()">
                                <option value="boton" <?= (empty($boton['url_destino']) ? 'selected' : '') ?>>Botón normal</option>
                                <option value="link" <?= (!empty($boton['url_destino']) ? 'selected' : '') ?>>Redirección (Link)</option>
                            </select>
                        </div>

                    <!-- Campo URL que se oculta o muestra -->
                    <div class="mb-3" id="contenedorLink" style="<?= (!empty($boton['url_destino']) ? '' : 'display:none;') ?>">
                    <label class="form-label"><b>URL de redirección</b></label>
                    <input type="text" class="form-control mb-2" name="url_destino" id="url_destino"
                        value="<?= htmlspecialchars($boton['url_destino'] ?? '') ?>">

                    </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="estado" name="estado" value="1"
                                <?= ($boton['estado'] ?? 0) == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="estado">
                                <b>Estado:</b> <span id="estado-label" class="<?= ($boton['estado'] ?? 0) == 1 ? 'text-success' : 'text-danger' ?>">
                                    <?= ($boton['estado'] ?? 0) == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </label>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" name="eliminar" class="btn btn-danger">🗑️ Eliminar</button>
                            <button type="submit" class="btn btn-primary">💾 Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
tinymce.init({
    selector: 'textarea[name="texto_chatbot"]',
    height: 400,
    menubar: false,
    branding: false,
    plugins: [
        'advlist autolink link image lists charmap anchor',
        'searchreplace wordcount visualblocks code fullscreen',
        'insertdatetime nonbreaking table paste help'
    ],
    toolbar: 'styleselect | bold italic underline | forecolor backcolor | ' +
             'alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | link image | code fullscreen',
    language: 'es',
    content_style: `
        body { font-family:Helvetica,Arial,sans-serif; font-size:14px; }
        p { margin: 0; padding: 0.2em 0; }
    `
});

const estadoCheckbox = document.getElementById('estado');
const estadoLabel = document.getElementById('estado-label');

estadoCheckbox.addEventListener('change', function () {
    estadoLabel.textContent = this.checked ? "Activo" : "Inactivo";
    estadoLabel.className = this.checked ? "text-success" : "text-danger";
});

// Mostrar u ocultar el input del link según tipo de acción
function mostrarInputLink() {
    const tipoAccion = document.getElementById('tipoAccion').value;
    const contenedorLink = document.getElementById('contenedorLink');
    if (tipoAccion === 'link') {
        contenedorLink.style.display = 'block';
    } else {
        contenedorLink.style.display = 'none';
        document.getElementById('url_destino').value = '';
    }
}

// Script del modal que tenías
document.getElementById('linkForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const url = document.getElementById('link-url').value;
    const text = document.getElementById('link-text').value || url;
    const title = document.getElementById('link-title').value;
    const target = document.getElementById('link-target').value;

    tinymce.activeEditor.execCommand('mceInsertContent', false,
        `<a href="${url}" title="${title}" target="${target}">${text}</a>`);

    const modal = bootstrap.Modal.getInstance(document.getElementById('modalLink'));
    modal.hide();
    this.reset();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
