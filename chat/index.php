<?php

    date_default_timezone_set('America/Guayaquil');
    header("Content-Type: text/html; charset=UTF-8");
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 300);
    include '../controller/controller_sql.php';
    $datos_sql = new datos_sql;

    $resultado = $datos_sql->select_menu();
    $resultado1 = $datos_sql1->select_nivel1();


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
        </style>  
    </head>
    <?php


    ?>
    
    <!-- chatbox_inicio -->
     <div class="chat_button chatbox--tray chatbox--empty" style="background: transparent !important; box-shadow: none !important; border: none !important;">
        <div class="boton boton-light boton-circle boton-xl boton-chat">Hola, te puedo ayudar con los servicios que ofrece la <b>CONAFIPS </b>!</div>
        <button type="button" class="btn btn-light btn-circle btn-xl boton-chat-icon"><img src="../images/logo1.png" alt="ChatBot"></button>
    </div>

    <div class="chatbox chatbox--tray chatbox--empty" id="chatbox">
        <div class="chatbox__title">
            <h5>Conafips Virtual </h5>
            <img src="../images/logo1.png" alt="Logo" class="chat-logo">
            <img src="../images/menos.png"  alt="Logo"class="chat-menos">
        </div>   

        <form class="chatbox__credentials">
            <div class="form-group">
                <center> <b> Bienvenido(a) Conafips virtual</b><br>
                <p align="justify"> El servicio de Consulta de Deudas y Pagos Pendientes en CONAFIPS 🔒. Este chatbot ha sido diseñado para asistirte en la verificación de obligaciones pendientes y la consulta de fideicomisos de cooperativas liquidadas, proporcionándote información clara sobre tu situación y los pasos a seguir en caso de mantener una deuda o acreencia.           
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

                        if ($resultado) {                           
                            foreach ($resultado as $resultado) {                               
                                $submenuId = htmlspecialchars($resultado['submenu']);
                                $imagen = htmlspecialchars($resultado['imagen']);
                                $texto = $resultado['texto']; // puede tener HTML
                                $href = htmlspecialchars($resultado['href']);
                                $onclick = htmlspecialchars($resultado['onclick']);

                                // Clases CSS según el texto
                                $claseMensaje = (stripos($texto, 'acreedor') !== false) ? 'mensaje-acreedor' : '';
                                $claseBoton = (stripos($texto, 'acreedor') !== false) ? 'botones_acreedor' : 'botones';

                                // Imprimir botón HTML
                                echo '
                                <div class="chatbox__body__message chatbox__body__message--left ' . $claseMensaje . '" id="' . $submenuId . '">
                                    <img src="' . $imagen . '" alt="logo">
                                    <p>
                                        <a href="#' . $href . '" class="btn ' . $claseBoton . '" role="button" aria-pressed="true"
                                        onClick="' . $onclick . '(\'' . $href . '\')">
                                            ' . $texto . '
                                        </a>
                                    </p>
                                </div>';
                            }
                        } else {
                            echo "<p style='color:red;'>No hay botones activos en la base de datos.</p>";
                        }
                        ?>
            </div>            

                 <!-- SUB MENU 1-->
            <div id="submt_segd" class="chatbox__body__message chatbox__body__message--left" style="display: none;">
                <div id="sub_menu1" style="scroll-behavior: smooth;">   
                    <div class="chatbox__body__message chatbox__body__message--left chat-bubble">
                        <img src="../images/logo1.png" alt="Logo" class="chat-logo1">
                        <p>¿Es deudor de las cooperativas liquidadas y actualmente extintas que constituyeron fideicomiso en la CONAFIPS?</p>
                    </div>
                    <div class="chatbox__body__message chatbox__body__message--left">
                        <img src="/chatbot/images/logo.png" alt="chat_cosede.png">
                        <p><input type="submit" class="btn" id="si_deudor" value="Sí" onClick="consultarDeudor()"></p>
                    </div>
                    <div class="chatbox__body__message chatbox__body__message--left">
                        <img src="/chatbot/images/logo.png" alt="chat_cosede.png">
                        <p><input type="submit" class="btn-back" id="Menu_principal" value="Regresar al menú principal" onClick="menu_principal()"><br><br></p>
                    </div>                        
                </div>
            </div>

            <!-- SUB MENU 2-->
            <div id="submt_acreedor1" class="chatbox__body__message chatbox__body__message--left" style="display: none;">
                <div id="sub_menu2" style="scroll-behavior: smooth;">   
                    <div class="chatbox__body__message chatbox__body__message--left chat-bubble">
                        <img src="../images/logo1.png" alt="Logo" class="chat-logo1">
                        <p>¿Es ACREEDOR de las cooperativas liquidadas y actualmente extintas que constituyeron fideicomiso en la CONAFIPS?</p>
                    </div>
                    <div class="chatbox__body__message chatbox__body__message--left">
                        <img src="/chatbot/images/logo.png" alt="chat_cosede.png">
                        <p><input type="submit" class="btn" id="si_acreedor" value="Sí" onClick="consultarAcreedor()"></p>
                    </div>
                    <div class="chatbox__body__message chatbox__body__message--left">
                        <img src="/chatbot/images/logo.png" alt="chat_cosede.png">
                        <p><input type="submit" class="btn-back" id="Menu_principal" value="Regresar al menú principal" onClick="menu_principal()"><br><br></p>
                    </div>                        
                </div>
            </div>

            </div> <!-- chatbox__body -->            
</div>
</body>
</html>

<script type="text/javascript">
    function consultarDeudor() {
        window.open("./deudor.php", "CONSULTA CIUDADANA", "width=825,height=574,scrollbars=NO");
        // Definimos la anchura y altura de la ventana
        var altura = 505;
        var anchura = 824;

        // Calculamos la posición x e y para centrar la ventana
        var y = parseInt((window.screen.height / 2) - (altura / 2));
        var x = parseInt((window.screen.width / 2) - (anchura / 2));
    }

    function consultarAcreedor() {
        window.open("./Acreedor.php", "CONSULTA CIUDADANA", "width=825,height=574,scrollbars=NO");
        // Definimos la anchura y altura de la ventana
        var altura = 505;
        var anchura = 824;

        // Calculamos la posición x e y para centrar la ventana
        var y = parseInt((window.screen.height / 2) - (altura / 2));
        var x = parseInt((window.screen.width / 2) - (anchura / 2));
    }
</script>
<script src="../asset/chatbot.js"></script>


</body>
</html> 