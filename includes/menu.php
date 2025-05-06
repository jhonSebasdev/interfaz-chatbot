<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
setlocale(LC_TIME, 'Spanish_Mexico'); // Windows
setlocale(LC_TIME, 'es_MX'); // Linux
date_default_timezone_set('America/Mexico_City');  // Ajusta a tu zona horaria
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);

include '../core/controller_sql.php';
$datos_sql = new datos_sql;
?>

<body id="body" class="dark-sidebar">
    <!-- leftbar-tab-menu -->
    <div class="left-sidebar">
        <!-- LOGO -->
        <div class="brand">
            <a class="logo" href="../micrositio/index.php">
                <span>
                    <img src="./assets/images/logo-data.png" alt="logo-large" class="logo-lg logo-light" width="200px">
                </span>
            </a>
        </div>

        <!-- Sidebar Menu -->
        <div class="menu-content h-100" data-simplebar>
            <div class="menu-body navbar-vertical">
                <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                    <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                        <li class="nav-item text-center">
                            <a class="nav-link" href="../index.php">
                                <span style="font-size: 18px;">Inicio</span>
                            </a>
                        </li>
                        <!-- Puedes agregar más ítems aquí -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <nav class="navbar-custom" id="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div>
                                <span class="d-none d-md-block fw-semibold font-12">
                                    Opciones <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="login.php">
                            <i class="ti ti-login font-16 me-1 align-text-bottom"></i> Ingresar
                        </a>
                        <a class="dropdown-item" href="loginout.php">
                            <i class="ti ti-power font-16 me-1 align-text-bottom"></i> Cerrar Sesión
                        </a>
                    </div>
                </li>
                <li class="notification-list">
                    <a class="nav-link arrow-none nav-icon offcanvas-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#Appearance" role="button" aria-controls="Rightbar">
                        <i class="ti ti-settings ti-spin"></i>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Scripts -->
    <script>
        function abrirVentana(url) {
            window.open(
                url,
                '_blank',
                'width=800,height=600,top=100,left=100,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no'
            );
        }

        // Agrega 'active' al item clicado
        document.addEventListener("DOMContentLoaded", () => {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    navLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
