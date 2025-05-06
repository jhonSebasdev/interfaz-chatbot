<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
setlocale(LC_TIME, 'Spanish_Mexico');
setlocale(LC_TIME, 'es_MX');
date_default_timezone_set('America/Mexico_City');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);

include '../core/controller_sql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $usuario = $_POST['username'];
    $password = $_POST['password'];

   $datos_sql1 = new datos_sql();

    $datos = $datos_sql1->validadatos($usuario);
    if ($datos && is_array($datos) && count($datos) > 0) {
        // Obtén la contraseña almacenada en la base de datos
        $stored_password = $datos[0]['password'];
        if ($password == $stored_password) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: ./gestionMenu.php");
            exit();
        } else {            
         //   header("Location: login.php");
          
            echo'
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Inicio de sesión</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="CONAFIPS" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />                                   
            <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.12.0/powerbi.js"></script>
            <script src="https://alcdn.msauth.net/browser/2.17.0/js/msal-browser.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>           
            <link rel="shortcut icon" href="assets/images/favicon.ico">          
            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
                rel="stylesheet">
        </head>
        <body id="body" class="auth-page">        
            <div class="container-md vh-100 d-flex justify-content-center align-items-center">
                <div class="row w-100">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <div class="card shadow-lg">
                            <div class="card-body auth-header-box">
                                <div class="text-center p-3">
                                    <img src="assets/images/logo-data.png" alt="logo-large" class="logo-lg logo-light"
                                        width="350px">
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                 <div class="ex-page-content text-center">                                        
                                        <h3 class="mt-5 mb-4">Nombre de usuario y/o contraseña incorrectas.</h3>
                                        <br>
                                        <br>
                                    </div> </br>  </br> </br>   
                                     <a class="btn btn-primary w-100" href="login.php"> Regresar <i class="fas fa-redo ml-1"></i></a>  
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
                <?php
                include_once "./includes/footer.php";
                ?>
            </div><!--end container-->
            <script src="assets/js/app.js"></script>
        </body>
        </html>
        <style>
            .material-icons {
                font-variation-settings:
                    "FILL" 0, "wght" 400,"GRAD" 0, "opsz" 48;font-size: 50px; color: #2b94da;                
                display: inline-block; vertical-align: middle; margin-right: 1px;                
            }
            p { display: inline-block; margin: 0;  }
            .page-wrapper .page-content-tab { display: flex; flex-direction: column; justify-content: center; }
            .brand {margin-top: 100px; }
        </style> ';
        
        }
    } else {
       // echo "Usuario no encontrado.";
     //   header("Location: login.php");
       
         echo'
      <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>Inicio de sesión</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="CONAFIPS" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />                                   
            <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.12.0/powerbi.js"></script>
            <script src="https://alcdn.msauth.net/browser/2.17.0/js/msal-browser.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>           
            <link rel="shortcut icon" href="assets/images/favicon.ico">          
            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
                rel="stylesheet">
        </head>
        <body id="body" class="auth-page">        
            <div class="container-md vh-100 d-flex justify-content-center align-items-center">
                <div class="row w-100">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <div class="card shadow-lg">
                            <div class="card-body auth-header-box">
                                <div class="text-center p-3">
                                    <img src="assets/images/logo-data.png" alt="logo-large" class="logo-lg logo-light"
                                        width="350px">
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                  <div class="ex-page-content text-center">                                        
                                        <h3 class="mt-5 mb-4">Usuario no existente.!</h3>
                                    </div></br>  </br> </br>
                                    <br>
                                    <br>
                                 <a class="btn btn-primary w-100" href="login.php"> Regresar <i class="fas fa-redo ml-1"></i></a>  
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
                <?php
                include_once "./includes/footer.php";
                ?>
            </div><!--end container-->
            <script src="assets/js/app.js"></script>
        </body>
        </html>
        <style>
            .material-icons {
                font-variation-settings:
                    "FILL" 0, "wght" 400,"GRAD" 0, "opsz" 48;font-size: 50px; color: #2b94da;                
                display: inline-block; vertical-align: middle; margin-right: 1px;                
            }
            p { display: inline-block; margin: 0;  }
            .page-wrapper .page-content-tab { display: flex; flex-direction: column; justify-content: center; }
            .brand {margin-top: 100px; }
        </style> ';      
    }
}
?>