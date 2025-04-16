(function ($) {
    $(document).ready(function () {
        var $chatbox = $('.chatbox'),
            $chatboxTitle = $('.chatbox__title'),
            $chatboxTitleClose = $('.chatbox__title__close'),
            $chatboxTitleCl = $('.chatbox__title__cl'),
            $chatboxCredentials = $('.chatbox__credentials'),
            $buttonchat = $('.boton-chat'),  // Botón principal del chatbot
            $chatboxIcon = $('.boton-chat-icon'), // Imagen dentro del botón
            $body = $('.chatbox__body');

        // Iniciar chatbox oculto
        $chatbox.hide();
        $chatboxIcon.show();

        // Función para abrir el chatbox
        function abrirChatbox(event) {
            event.stopPropagation(); // Evita que el clic se propague
            $buttonchat.hide();
            $chatbox.show();
            $chatboxIcon.hide();
            
            $chatbox.toggleClass('chatbox--tray');
        }

        // Hacer que el botón y la imagen dentro del botón abran el chatbox
        $buttonchat.on('click', abrirChatbox);
        $chatboxIcon.on('click', abrirChatbox);

        // Evitar que clics en el contenedor vacío del chatbox lo abran
        $('.chatbox__tray').on('click', function (event) {
            event.stopPropagation();
        });

        // Cerrar el chat si se hace clic fuera de él
        $(document).on('click', function (event) {
            if (!$chatbox.is(event.target) && $chatbox.has(event.target).length === 0 && !$buttonchat.is(event.target) && !$chatboxIcon.is(event.target)) {
                $chatbox.hide();
                $buttonchat.show();
                $chatboxIcon.show();
            }
        });

        // Se abre el chatbox después de aceptar políticas de seguridad
        $chatboxCredentials.on('submit', function (e) {
            e.preventDefault();
            $chatbox.removeClass('chatbox--empty');
        });

        //Minimizar chatbox al hacer clic en la barra de título
        $chatboxTitle.on('click', function () {
            $chatbox.toggleClass('chatbox--tray');
            $chatbox.hide();
            $buttonchat.show();
            $chatboxIcon.show();
        });
    });
})(jQuery);

// Función para mostrar el submenú de deudores
function submt_deudor(id) {
    console.log("Ejecutando función submt_deudor con ID:", id);

    var el = document.getElementById(id);
    if (el) {
        el.style.display = (el.style.display === 'none') ? 'block' : 'none';

        if (window.jQuery) {
            $('#index').hide();
            $('#' + id).show();
            $('#sub_menu1').show();
        } else {
            console.warn("jQuery no está cargado. Asegúrate de incluirlo.");
        }
    } else {
        console.error("Elemento con ID '" + id + "' no encontrado.");
    }
}

//Función para mostrar el submenú de acreedores
function submt_acreedor(id) {
    console.log("Ejecutando función submt_acreedor con ID:", id);

    var el = document.getElementById(id);
    if (el) {
        el.style.display = (el.style.display === 'none') ? 'block' : 'none';

        if (window.jQuery) {
            $('#index').hide();
            $('#' + id).show();
            $('#sub_menu2').show();
        } else {
            console.warn("jQuery no está cargado. Asegúrate de incluirlo.");
        }
    } else {
        console.error("Elemento con ID '" + id + "' no encontrado.");
    }
}


/**
 * Función generalizada para mostrar submenús
 * @param {string} id - ID del elemento a mostrar/ocultar
 * @param {string} submenuId - ID del submenú a mostrar (sub_menu1 o sub_menu2)
 */
function toggleSubmenu(id, submenuId) {
    console.log(`Ejecutando función toggleSubmenu con ID: ${id}, Submenú: ${submenuId}`);
    var el = document.getElementById(id);
    
    if (!el) {
        console.error(`Elemento con ID '${id}' no encontrado.`);
        return;
    }
    
    // Alternar la visibilidad del elemento
    el.style.display = (el.style.display === 'none') ? 'block' : 'none';
    
    // Si jQuery está disponible, realizar operaciones adicionales
    if (window.jQuery) {
        $('#index').hide();
        $(`#${id}`).show();
        $(`#${submenuId}`).show();
    } else {
        console.warn("jQuery no está cargado. Asegúrate de incluirlo.");
    }
}

// Función para el submenú de deudores
function submt_deudor(id) {
    toggleSubmenu(id, 'sub_menu1');
}

// Función para el submenú de acreedores
function submt_acreedor(id) {
    toggleSubmenu(id, 'sub_menu2');
}




// Función para regresar al menú principal
function menu_principal() {
    $('#index').show();
    $('#submt_acreedor1').hide(); // cambiado
    $('#sub_menu1').hide();
    $('#submt_deudor1').hide(); // cambiado
    $('#sub_menu2').hide();
}

//Función para manejar el submenú de acreedores y seguridad
function submt_segd2(id) {
    var el = document.getElementById(id);
    if (el) {
        el.style.display = (el.style.display === 'none') ? 'block' : 'none';

        if (window.jQuery) {
            $('#index').hide();
            $('#submt_deudor1').show(); // cambiado
            $('#sub_menu_acreedor').show();
        } else {
            console.warn("jQuery no está cargado.");
        }
    } else {
        console.error("Elemento con ID '" + id + "' no encontrado.");
    }
}

// Función para el menú de Contribución 
function submt_fonr(id) {
    var el = document.getElementById(id);
    if (el) {
        el.style.display = (el.style.display === 'none') ? 'block' : 'none';
        $('#index').hide();
        $('#submt_fond').show();
        $('#menu_fon').show();
    }
}

// Función para mostrar imágenes relacionadas a COSEDE
function img_csdr(id) {
    if (document.getElementById) {
        var el = document.getElementById(id);
        el.style.display = (el.style.display == 'none') ? 'block' : 'none';
        $('#index').hide();
        $('#img_csdd').show();
        $('#menu_csd').show();
        $('#menu_csd1').show();
    }
}
