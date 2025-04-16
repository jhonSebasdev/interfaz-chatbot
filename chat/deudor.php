
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Deudores CONAFIPS</title>

    <!-- Estilos -->
    <style type="text/css">
      /* Estilos mejorados */ 
      .input-container {
          display: flex;
          align-items: center;
          gap: 10px;
          justify-content: center;
          margin-top: 20px;
      }

      input[type="text"] {
          width: 250px;
          padding: 10px;
          border: 2px solid #1F618D;
          border-radius: 5px;
          font-size: 14px;
          font-family: Verdana, sans-serif;
      }

      input[type="text"]:focus {
          outline: none;
          border-color: #2980B9;
          box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
      }

      .search-button {
          background: none;
          border: none;
          cursor: pointer;
      }

      .search-button img {
          width: 50px;
          transition: transform 0.2s;
      }

      .search-button:hover img {
          transform: scale(1.1);
      }

      .logo-container {
          text-align: center;
          margin-top: 20px;
      }

      .logo-container img {
          width: 225px;
          max-width: 100%;
      }

      /* Posición de la imagen en la parte inferior izquierda */
      .bottom-left-logo {
          position: fixed;
          bottom: 10px;
          left: 10px;
          width: 120px; /* Ajusta el tamaño según necesidad */
      }

      /* Estilos para mostrar el resultado de la búsqueda */
      #resultadoBusqueda {
          margin-top: 20px;
          text-align: center;
          font-family: Verdana, sans-serif;
      }

      #resultadoBusqueda p {
          font-size: 14px;
          color: #1F618D;
          font-weight: bold;
      }
      /* Estilos para mostrar el resultado de la búsqueda */
      #resultadoBusqueda {
          margin-top: 20px;
          text-align: center;
          font-family: Verdana, sans-serif;
          font-weight: bold;
          color: #1F618D;
      }

      /* Estilos para la consulta SQL generada */
      #consultaSQL {
          margin-top: 20px;
          padding: 10px;
          border: 1px solid #1F618D;
          background-color: #f4f4f4;
          font-family: monospace;
          white-space: pre-wrap;
          word-wrap: break-word;
      }

      .titulo-DEUDOR {
        font-family: 'Segoe UI', Verdana, sans-serif;
        font-size: 15px;
        font-weight: bold;
        color: #1F618D;
        border: 2px solid #1F618D;
        padding: 11px 11px;
        width: fit-content;
        margin: 15px auto;
        border-radius: 10px;
        letter-spacing: 0px;
    }

    </style>
    </style>

    <!-- Cargar jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="content">
    
    <!-- Agregamos la imagen principal -->
    <div class="logo-container">
        <img src="../images/CONAFIPS.png" alt="Conafips Reactiva Tu Negocio">
        <p class="titulo-DEUDOR">DEUDOR</p>

</div>
    </div>

    <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="3">
                <p align="justify" style="font-family: verdana; font-size:12px">
                    Estimado Usuario,<br><br>
                    ¿Es deudor de las cooperativas liquidadas y actualmente extintas que constituyeron fideicomiso en la CONAFIPS? 
                    Ingrese su número de identificación para verificar su estado.
                </p>
            </td>
        </tr>   
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="94%" align="center" valign="top">
                <form id="consulta-form">
                    <div class="input-container">
                        <input type="text" name="identificacion" id="identificacion" placeholder="Ingrese su identificación">
                        <button type="submit" class="search-button">
                            <img src="../images/lupa.png" alt="Buscar" title="Búsqueda de información">
                        </button>
                    </div>
                </form>

                <!-- Contenedor para mostrar el resultado debajo del input -->
                <div id="resultadoBusqueda"></div>

            </td>
        </tr>   
    </table>

    <!-- Imagen en la parte inferior izquierda -->
    <img src="../images/conafips_logo.png" alt="Conafips Logo" class="bottom-left-logo">
</div>



</body>
</html>


<script>

    // Agregar este código JavaScript al final de tu página o en un archivo .js separado
    document.addEventListener('DOMContentLoaded', function() {
        const consultaForm = document.getElementById('consulta-form');
        const resultadoBusqueda = document.getElementById('resultadoBusqueda');
        
        consultaForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de forma tradicional
            realizarConsulta();
        });
        
        // También podemos agregar el evento al botón específicamente
        document.querySelector('.search-button').addEventListener('click', function(event) {
            event.preventDefault();
            realizarConsulta();
        });
        
        function realizarConsulta() {
            const identificacion = document.getElementById('identificacion').value;
            
            if (identificacion.trim() === '') {
                resultadoBusqueda.innerHTML = '<p class="error">Por favor ingrese una identificación</p>';
                return;
            }
            
            // Mostrar indicador de carga
            resultadoBusqueda.innerHTML = '<div class="loader">Cargando...</div>';
            
            // Crear objeto XMLHttpRequest (AJAX tradicional)
            const xhr = new XMLHttpRequest();
            
            // Configurar la petición
            xhr.open('POST', 'buscar_deudor.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            // Configurar el manejador de la respuesta
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Mostrar los resultados en el div
                        resultadoBusqueda.innerHTML = xhr.responseText;
                    } else {
                        resultadoBusqueda.innerHTML = '<p class="error">Error en el servidor: ' + xhr.status + '</p>';
                    }
                }
            };
            
            // Enviar la petición con los datos
            xhr.send('identificacion=' + encodeURIComponent(identificacion));
        }
    });

    </script>