<?php


// Archivo para la conexion
include_once './Connection/exec_sql.php';

//Clase que conecta a la base de datos
class datos_sql extends exec_sql
{

    public function select_datos_proveedor($cedula)  {
        $sql_ap = " SELECT * FROM coop_proveedor  WHERE cedula = $cedula";
        return $this->cargar($sql_ap);
    }

}