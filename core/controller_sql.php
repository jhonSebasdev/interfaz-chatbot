<?php
include_once '../Connection/exec_sql.php';

class datos_sql extends exec_sql
{
    private $conn;

    public function __construct() {
        // Ya no llamamos al constructor del padre porque no existe

        $this->conn = new mysqli("localhost", "root", "", "cooperativas");

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function limpiar($cadena) {
        return htmlspecialchars(trim($cadena), ENT_QUOTES, 'UTF-8');
    }

    public function select_menu() {
        $sql = "SELECT * FROM menu ORDER BY id ASC";
        return $this->cargar($sql);
    }

    public function select_datos_deudor($cedula) {
        $cedula = $this->limpiar($cedula);
        $sql_ap = "SELECT * FROM coop_acreedor WHERE cedula = '$cedula'";
        return $this->cargar($sql_ap);
    }

    public function validadatos($usuario) {
        $usuario = $this->limpiar($usuario);
        $sql = "SELECT * FROM usuarios WHERE username = '$usuario'";
        return $this->cargar($sql);
    }

    public function obtener_contenido_nivel2($submenu) {
        $submenu = $this->limpiar($submenu);
        $sql = "SELECT * FROM tabla_nivel2 WHERE submenu = '$submenu'";
        return $this->cargar($sql);
    }

    public function select_nivel1() {
        $sql = "SELECT * FROM menu";
        $resultado = $this->conn->query($sql);
        $datos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
        return $datos;
    }
}
?>
