<?php
date_default_timezone_set('America/Guayaquil');
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);
include_once "../includes/encabezado.php";
include_once "../includes/menu.php";

$datos_sql = new datos_sql;
$resultado = $datos_sql->select_menu();

?>


<head>
    
        <title>Chat Box</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap JS y Popper (para dropdowns) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../asset/bootstrap.min.css">
         <script src="../asset/jquery.min.js"></script>
         <script src="../asset/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="../asset/chatbox.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .carousel, .carousel-inner > .item > img {
                height: 150px;
                width: 250px;
                align: center;
            }            
            body{
                background:none transparent;
            }
            .modal-backdrop {
                visibility: hidden !important;
            }
            .modal-lg {
               max-width: 50%;
            }
            /* Estilo para el indicador de carga */
            #cargando {
                text-align: center;
                padding: 20px;
                font-style: italic;
                color: #666;
            }
        </style>
        
       
    </head>

    <div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content-tab">
        <div class="container-fluid">
            <!-- Page-Title -->
            <!-- end page title end breadcrumb -->

            <div class="row">
            <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="blog-card">
                        <!-- Header with icon and title -->
                        <div class="text-center mb-3">
                        <a href="javascript:void(0);" onclick="window.open('nivel1.php', 'popup', 'width=800,height=600');">
                         <img src="assets/images/añadir.png" alt="Añadir" style="width: 60px; height: 60px;">
                         </a>
                        <h5 class="mt-2"><b>Añadir botón<br>NIVEL 1</b></h5>
                        </div>
                        
                        <!-- Content section con scroll más largo -->
                        <div class="card-content" style="max-height: 600px; overflow-y: auto;">
                            <div class="card-header">
                            <div id="index">      
                                <div class="chatbox__body__message chatbox__body__message--left chat-bubble" id="menini">
                                    <img src="../images/logo1.png" alt="Logo2222" class="chat-logo1">                    
                                    <p>Hola, puede seleccionar de los botones siguientes para realizar su consulta.</p>
                                    </div>
                                     <br>                  
                                    <?php                     

                                    if ($resultado) {                          
                                        foreach ($resultado as $resultado) {                               
                                            $submenuId = htmlspecialchars($resultado['submenu']);
                                            $imagen = htmlspecialchars($resultado['imagen']);
                                            $texto = $resultado['texto']; // puede tener HTML
                                            $submenu = htmlspecialchars($resultado['submenu']); 
                                        
                                            $onclick = "cargarNivel2" ; 


                                            // Clases CSS según el texto
                                            $claseMensaje = (stripos($texto, 'acreedor') !== false) ? 'mensaje-acreedor' : '';
                                            $claseBoton = (stripos($texto, 'acreedor') !== false) ? 'botones_acreedor' : 'botones';

                                            // Imprimir botón HTML
                                            echo '
                                            <div class="chatbox__body__message chatbox__body__message--left ' . $claseMensaje . '" id="' . $submenuId . '" 
                                                style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">

                                                <!-- Imagen del robot (alineada verticalmente al centro) -->
                                                <div style="flex-shrink: 0; display: flex; align-items: center; justify-content: center; height: 100%;">
                                                
                                                </div>

                                                <!-- Burbuja morada + botón ⋮ -->
                                                <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                                                    <a href="#' . $submenu . '" class="btn ' . $claseBoton . '" role="button" aria-pressed="true"
                                                        onClick="' . $onclick . '(\'' . $submenu . '\')" style="flex: 1;">
                                                        ' . $texto . '
                                                    </a>

                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm" style="font-size: 20px;" title="Opciones"
                                                            onclick="window.open(\'editar_boton.php?submenu=' . $submenuId . '\', \'popup\', \'width=800,height=600\');">
                                                            ⋮
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="#">Editar</a></li>
                                                            <li><a class="dropdown-item text-danger" href="#">Eliminar</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>';
                                        }
                                    } else {
                                        echo "<p style='color:red;'>No hay botones activos en la base de datos.</p>";  
                                    }

                                    ?>
                            </div>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                        <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="blog-card">

                                
                               <!-- Header con icono y título que se actualizará dinámicamente -->
                                <div id="contenedor_boton_añadir" class="text-center mb-3">
                                    <a href="javascript:void(0);">
                                        <img src="assets/images/añadir.png" alt="Añadir" style="width: 60px; height: 60px; opacity: 0.0;">
                                    </a>
                                    <h5 class="mt-2 text-muted" style="opacity: 0.0;"><b>Añadir botón<br>NIVEL 2</b></h5>
                                </div>



                                <!-- Contenido scrollable -->
                                <div class="card-content" style="max-height: 600px; overflow-y: auto;">
                                    <div class="card-header">
                                        <div id="nivel2_contenido">      
                                            <img id="imagen_nivel2" src="assets/images/chatbot_izquierda_nivel2.png" alt="Chatbot Nivel 2" style="max-width: 100%; height: auto;">
                                        </div>    
                                    </div>
                                </div>

                                <hr class="hr-dashed">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="meta-box">
                                        <div class="media">
                                            <div class="col-sm-9">
                                                <!-- Espacio adicional -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Script para cargar Nivel 2 -->
                                <script>
                                    function cargarNivel2(submenuPadre) {
                                    const nivel2Contenido = document.getElementById('nivel2_contenido');
                                    const imagenNivel2 = document.getElementById('imagen_nivel2');

                                    if (imagenNivel2) imagenNivel2.style.display = 'none';

                                    nivel2Contenido.innerHTML = '<div class="text-center p-2"> Cargando...</div>';

                                    fetch('./obtener_nivel2.php?id=' + encodeURIComponent(submenuPadre))
                                        .then(response => {
                                            if (!response.ok) throw new Error('Error en la solicitud');
                                            return response.text();
                                        })
                                        .then(data => {
                                            // Insertar el contenido del nivel 2
                                            nivel2Contenido.innerHTML = data;

                                            // También actualizar el botón de añadir con el submenuPadre
                                            const contenedorBtn = document.getElementById('contenedor_boton_añadir');
                                            if (contenedorBtn) {
                                                contenedorBtn.innerHTML = `
                                                    <a href="javascript:void(0);" onclick="window.open('nivel2.php?submenu=${submenuPadre}', 'popup', 'width=800,height=600');">
                                                        <img src="assets/images/añadir.png" alt="Añadir" style="width: 60px; height: 60px;">
                                                    </a>
                                                    <h5 class="mt-2"><b>Añadir botón<br>NIVEL 2</b></h5>
                                                `;
                                            }
                                        })
                                        .catch(error => {
                                            nivel2Contenido.innerHTML = `<p style="color:red;">Error: ${error.message}</p>`;
                                        });
                                }

                                </script>
                                
                            </div><!-- end blog-card -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->









                <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="blog-card">

                            <!-- Header con icono y título -->
                            <div class="text-center mb-3">
                                <a href="javascript:void(0);" onclick="window.open('nivel2.php', 'popup', 'width=800,height=600');">
                                    <img src="assets/images/añadir.png" alt="Añadir" style="width: 60px; height: 60px;">
                                </a>
                                <h5 class="mt-2"><b>Añadir botón<br>NIVEL 3</b></h5>
                            </div>

                            <!-- Contenido scrollable -->
                            <div class="card-content" style="max-height: 600px; overflow-y: auto;">
                                <div class="card-header">
                                    <div id="index">      
                                        <img src="assets/images/chatbot_izquierda_nivel3.png" alt="Chatbot Nivel 2" style="max-width: 100%; height: auto;">
                                    </div>    
                                </div>
                            </div>

                            <hr class="hr-dashed">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="meta-box">
                                    <div class="media">
                                        <div class="col-sm-9">
                                            <!-- Contenido adicional si se requiere -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end blog-card -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <?php
            include_once "../includes/footer.php";
            ?>
