<?php
include_once '../Connection/exec_sql.php';

class datos_sql extends exec_sql
{
    /**  Método para limpiar entradas */
    public function limpiar($cadena) {
        return htmlspecialchars(trim($cadena), ENT_QUOTES, 'UTF-8');
    }

    /** Nuevo método para traer los botones del menú */
    public function select_menu() {
        $sql = "SELECT * FROM menu ORDER BY id ASC";
        return $this->cargar($sql);
    }

    /** Consulta para obtener los datos del deudor por cédula */
    public function select_datos_deudor($cedula) {
        $cedula = $this->limpiar($cedula);
        $sql_ap = "SELECT * FROM coop_acreedor WHERE cedula = '$cedula'";
        return $this->cargar($sql_ap);
    }

    /** Validar usuario (login) */
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
    


}
?>
