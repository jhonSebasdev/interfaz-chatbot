# 🤖 interfaz_chatbot_multinivel - Chatbot Multinivel Dinámico

Este proyecto es un sistema de chatbot web 100% modificable, construido con una estructura **por niveles** y totalmente conectado a una base de datos MySQL. Permite agregar, editar y eliminar contenido sin tocar el código fuente.

## 🚀 Características

- Interfaz dividida en niveles jerárquicos (Nivel 1, 2, 3)
- Botones e interacciones cargadas dinámicamente desde base de datos
- Panel de administración intuitivo para gestionar contenido
- Estructura escalable y fácilmente mantenible
- Compatible con Bootstrap, PHP, MySQL y JavaScript

## 📦 Estructura del Proyecto

```
interfaz_chatbot_multinivel/
├── nivel1.php
├── nivel2.php
├── nivel3.php
├── obtener_nivel_2.php
├── core/
│   └── db.php
├── Connection/
│   └── exec_sql.php
├── assets/
│   └── images/
├── js/
│   └── funciones_chatbot.js
├── css/
│   └── estilos.css
├── sql/
│   └── estructura_tablas.sql
└── README.md
```

## ⚙️ Requisitos

- PHP 7.4 o superior
- Servidor Apache (XAMPP/WAMP)
- MySQL 5.7 o superior

## 🧠 Cómo usar

1. Clona el repositorio:
   ```bash
   git clone https://github.com/jhonSebasdev/interfaz_chatbot_multinivel.git
   ```
2. Importa la base de datos desde `sql/estructura_tablas.sql`
3. Configura `core/db.php` con tus credenciales
4. Ejecuta `nivel1.php` desde tu servidor local
5. ¡Empieza a crear botones y ver el flujo por niveles!

## ✍️ Autor

**Jhon Sebastian Huertas Cristancho**  
Desarrollador de Software  
[GitHub - jhonSebasdev](https://github.com/jhonSebasdev)