<?php

date_default_timezone_set('America/Guayaquil');
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);
include '../core/controller_sql.php';
$datos_sql = new datos_sql;

$resultado = $datos_sql->select_menu();
$resultado1 = $datos_sql->select_nivel1();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Box</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <script src="../asset/jquery.min.js"></script>
    <script src="../asset/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="../asset/chatbox.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .carousel, .carousel-inner > .item > img { height: 150px; width: 250px; align: center; }
        body { background: none transparent; }
        .modal-backdrop { visibility: hidden !important; }
        .modal-lg { max-width: 50%; }
    </style>
</head>
<body>

<!-- chatbox_inicio -->
<div class="chat_button chatbox--tray chatbox--empty" style="background: transparent !important; box-shadow: none !important; border: none !important;">
    <div class="boton boton-light boton-circle boton-xl boton-chat">Hola, te puedo ayudar con los servicios que ofrece la <b>CONAFIPS</b>!</div>
    <button type="button" class="btn btn-light btn-circle btn-xl boton-chat-icon">
        <img src="../images/logo1.png" alt="ChatBot">
    </button>
</div>

<div class="chatbox chatbox--tray chatbox--empty" id="chatbox">
    <div class="chatbox__title">
        <h5>Conafips Virtual</h5>
        <img src="../images/logo1.png" alt="Logo" class="chat-logo">
        <img src="../images/menos.png" alt="Logo" class="chat-menos">
    </div>

    <form class="chatbox__credentials">
        <div class="form-group">
            <center>
                <b>Bienvenido(a) Conafips virtual</b><br>
                <p align="justify">El servicio de Consulta de Deudas y Pagos Pendientes en CONAFIPS 🔒. Este chatbot ha sido diseñado para asistirte en la verificación de obligaciones pendientes y la consulta de fideicomisos de cooperativas liquidadas, proporcionándote información clara sobre tu situación y los pasos a seguir en caso de mantener una deuda o acreencia.</p>
                <a href="politicas.html" target="_blank">POLÍTICA DE PRIVACIDAD</a>
            </center>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-custom-start btn-block">Iniciar</button>
                </div>
                <br><br/>
                <div class="col-sm-6 cancel_button">
                    <a href="index.php" class="btn btn-custom-cancel btn-block" role="button" aria-pressed="true">Cancelar</a>
                </div>
            </div>
        </div>
    </form>

<div class="chatbox__body">
<!-- MENU -->
<div id="img_csdd" class="chatbox__body__message chatbox__body__message--left" style="display: none;">
    <img src="../images/logo1.png" alt="chat_cosede.png">
</div>

<div id="index">
    <div class="chatbox__body__message chatbox__body__message--left chat-bubble" id="menini">
        <img src="../images/logo1.png" alt="Logo2222" class="chat-logo1">
        <p>Hola, puede seleccionar de los botones siguientes para realizar su consulta.</p>
    </div>
    <br>

<?php
foreach ($resultado as $row) {
    $submenuId = htmlspecialchars($row['submenu']);
    $texto = $row['texto'];
    $url_destino = trim($row['url_destino'] ?? '');

    echo '<div class="chatbox__body__message chatbox__body__message--left" id="' . $submenuId . '" style="background: none; box-shadow: none; padding: 0; margin: 0;">';

    //if (!empty($url_destino)) {
     //   echo '<button type="button" class="btn botones" onclick="redirigirConLink(\'' . htmlspecialchars($url_destino) . '\')" style="margin:5px 0; width:100%;">' . $texto . '</button>';
    //} else {
        echo '<button type="button" class="btn botones" onclick="mostrarNivel2(\'' . $submenuId . '\')" style="margin:5px 0; width:100%;">' . $texto . '</button>';
   // }

    echo '</div>';
}
?>
</div>

<!-- CONTENEDOR PARA NIVEL 2 -->
<div id="nivel2_dinamico" class="chatbox__body__message chatbox__body__message--left" style="display: none;">
    <div id="contenedor_nivel2">
        <?php
        function eliminarEtiquetasHTML($texto) {
            $sinA = preg_replace('/<a\b[^>]*>(.*?)<\/a>/is', '$1', $texto);
            return strip_tags($sinA);
        }

        foreach ($resultado1 as $row):
            $submenuId = htmlspecialchars($row['submenu']);
            $texto = $row['texto'];
            $url_destino = trim($row['url_destino'] ?? '');
        ?>
        <div class="chatbox__body__message chatbox__body__message--left">
        <?php if (!empty($url_destino)): ?>
            <button type="button" class="btn btn-primary mb-2" style="background-color: #6c2eb9; border: none; width: 100%; padding: 10px; color: white; font-weight: bold; border-radius: 10px; text-align: center; white-space: normal;" onclick="redirigirConLink('<?= htmlspecialchars($url_destino) ?>')">
                <?= $texto ?>   HOLAAAA 1
            </button>
        <?php else: ?>
            <button type="button" class="btn btn-primary mb-2" style="background-color: #6c2eb9; border: none; width: 100%; padding: 10px; color: white; font-weight: bold; border-radius: 10px; text-align: center; white-space: normal;" onclick="mostrarNivel2('<?= $submenuId ?>')">
                <?= $texto ?>   HOLA 2222
            </button>
        <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</div>
</div>
<!-- SCRIPTS -->
<script>
function mostrarNivel2(submenuPadre) {
    const boton = document.getElementById(submenuPadre);
    if (boton && boton.hasAttribute('data-url')) {
        const url = boton.getAttribute('data-url');
        if (url) {
            window.open(url, '_blank');
            return;
        }
    }
    const contenedor = $('#contenedor_nivel2');
    const divNivel2 = $('#nivel2_dinamico');

    $('#img_csdd').hide();
    $('#index').hide();
    divNivel2.show();

    contenedor.html(`<div class='chatbox__body__message chatbox__body__message--left'><p style='color:gray;'>Cargando contenido...</p></div>`);

    fetch(`../interfaz/crea_nivel2.php?id=${submenuPadre}`)
        .then(res => res.text())
        .then(data => {
            contenedor.html(data);
        })
        .catch(err => {
            contenedor.html(`<p style='color:red;'>Error al cargar nivel 2: ${err}</p>`);
        });
}

function regresarMenu() {
    $('#index').show();
    $('#img_csdd').show();
    $('#nivel2_dinamico').hide();
}

function redirigirConLink(url) {
    if (url) {
        window.open(url, '_blank');
    } else {
        console.warn("URL no válida.");
    }
}
/*
function cargarNivel3(id) {
    alert('Funcionalidad de Nivel 3 aún no implementada.');
}*/
</script>
<script src="../asset/chatbot.js"></script>
</body>
</html>
