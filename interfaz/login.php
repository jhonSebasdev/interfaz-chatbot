<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <title>Inicio de sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    



    <!-- App css -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.12.0/powerbi.js"></script>
    <script src="https://alcdn.msauth.net/browser/2.17.0/js/msal-browser.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- App favicon -->
    
    <!-- App css -->
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
    <!-- Log In page -->
    <div class="container-md vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body auth-header-box">
                        <div class="text-center p-3">
                            <img src="assets/images/logo-data.png" alt="logo-large" class="logo-lg logo-light"
                                width="300px"  margin-top="">
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <form class="my-4" action="valida.php" method="POST">
                            <div class="form-group mb-3">
                                <label class="form-label" for="username">Usuario</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username"
                                    placeholder="Ingrese su usuario" required>
                            </div><!--end form-group-->

                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Contraseña</label>
                                <input type="password" class="form-control form-control-lg" name="password"
                                    id="userpassword" placeholder="Ingrese su contraseña" required>
                            </div><!--end form-group-->

                            <div class="form-group mb-0 row">
                                <div class="col-12">
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary btn-lg" type="submit">Iniciar sesión <i
                                                class="fas fa-sign-in-alt ms-1"></i></button>
                                    </div>
                                </div><!--end col-->
                            </div> <!--end form-group-->
                        </form><!--end form-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
        <?php
        include_once('../includes/footer.php');

        ?>
    </div><!--end container-->

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>


<style>
    .material-icons {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 48;
        font-size: 50px;
        /* Tamaño del ícono */
        color: #2b94da;
        /* Color del ícono */
        display: inline-block;
        /* Permite que el ícono se alinee con el texto */
        vertical-align: middle;
        /* Alinea verticalmente */
        margin-right: 1px;
        /* Espacio entre el ícono y el texto */
    }

    p {
        display: inline-block;
        /* Para que el párrafo también se alinee */
        margin: 0;
        /* Elimina el margen por defecto del párrafo */
    }

    .page-wrapper .page-content-tab {

        /* Flexbox para centrar verticalmente */
        display: flex;
        flex-direction: column;
        /* Por si tienes varios elementos */
        justify-content: center;
        /* CÃ©ntralo verticalmente */
    }

    .brand {
        margin-top: 100px;
        /* Espacio encima del logo */
    }
</style>