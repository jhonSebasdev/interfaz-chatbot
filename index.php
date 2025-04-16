<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conafips virtual</title>
    <style>
        /* Estilos para el contenedor del chatbot */
        .chatbot-container {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 450px;
            height: 410px;
            z-index: 1000;
            overflow: hidden;
        }

        /* Estilos para el iframe del chatbot */
        .chatbot-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Contenido de tu sitio web -->
    <h1>Bienvenido a mi sitio web</h1>
    <p>Este es un ejemplo de cómo integrar un chatbot en tu sitio.</p>

    <!-- Chatbot Container -->
    <div class="chatbot-container">
        <iframe class="chatbot-iframe" src="./chat/" title="CONAFIPS CHAT"></iframe>
    </div>
</body>
</html>
