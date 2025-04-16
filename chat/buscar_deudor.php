<?php

date_default_timezone_set('America/Guayaquil');
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);
include './controller/controller_sql.php';
$datos_sql = new datos_sql;

// Verificar que existe el parámetro identificacion
if (!isset($_REQUEST['identificacion']) || empty($_REQUEST['identificacion'])) {
    echo "<div style='border: 2px solid #333; padding: 15px; border-radius: 10px; background-color: #f8f8f8; width: fit-content; text-align: left; font-family: Arial, sans-serif;'>
    <p style='margin: 0;'>Por favor, ingrese un número de identificación válido.</p>
    </div>";
    exit;
}

$cedula = $_REQUEST['identificacion'];
$resultado = $datos_sql->select_datos_deudor($cedula);

// Contenedor principal con bordes y fondo
echo "<div style='border: 2px solid #333; padding: 20px; border-radius: 10px; background-color: #f8f8f8; width: fit-content; text-align: left; font-family: Arial, sans-serif;'>";

if (empty($resultado) || !isset($resultado[0]) || !isset($resultado[0]['cedula'])) {
    echo "<p>No hemos encontrado ninguna deuda registrada a su nombre en los fideicomisos administrados.</p>";
    echo "<p>Si necesita más información, comuníquese con la Subgerencia de Coactivas al (593)-2 3801910 al 19 ext. 223 o 273.</p>";
} else {
    $fideicomiso = $resultado[0]['fideicomiso'];
    $cooperativa = $resultado[0]['cooperativa'];
    $cedula = $resultado[0]['cedula'];
    $nombre = $resultado[0]['nombre'];
    $tipo = $resultado[0]['tipo'];

    echo "<p><strong>Estimado/a $nombre,</strong></p>";
    echo "<p>Según nuestros registros, usted mantiene obligaciones pendientes de pago con la Cooperativa <strong>$cooperativa</strong> dentro del fideicomiso <strong>$fideicomiso</strong>.</p>";
    echo "<p><strong>Estado:</strong> $tipo</p>";
    echo "<p><strong>Número de cédula:</strong> $cedula</p>";
    echo "<p>Para más información, le recomendamos seguir las siguiemtes instrucciones.</p>";

    // Línea divisoria
    echo "<hr style='border: 1px solid #333;'>";

    // Sección de pasos a seguir
    echo "<h3>Pasos a seguir para resolver su obligación:</h3>";
    echo "<ol>";
    echo "<li>Enviar oficio al correo electrónico a: <strong>atencion.cliente@finanzaspopulares.gob.ec</strong> o entregarlo personalmente en las oficinas de CONAFIPS.</li>";
    echo "<li><strong>Fecha de ingreso del oficio:</strong> " . date('Y') . "</li>";
    echo "<li>Detallar su requerimiento.</li>";
    echo "<li><strong>N° de juicio.</strong></li>";
    echo "<li>Detallar a qué Cooperativa en liquidación pertenece.</li>";
    echo "<li>El documento tiene que estar debidamente suscrito/firmado.</li>";
    echo "<li>Enviar el documento en formato <strong>PDF</strong>, no se aceptan imágenes; debe ser escaneado.</li>";
    echo "<li>Incluir los datos de contacto para notificaciones:</li>";
    echo "<ul>";
    echo "<li>Número de Cédula de la persona solicitante.</li>";
    echo "<li>Número de teléfono.</li>";
    echo "<li>Correo electrónico.</li>";
    echo "<li>Adjuntar copia de cédula de identidad del solicitante.</li>";
    echo "</ul>";
    echo "</ol>";
}

echo "</div>"; // Cierre del contenedor principal

?>
