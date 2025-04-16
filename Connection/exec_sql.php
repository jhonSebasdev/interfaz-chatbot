<?php
// Activar sesión si no está activa
if (!isset($_SESSION)) {
    ini_set("session.gc_maxlifetime", "14400");
    session_start();
}

class exec_sql {

    /** Consulta que retorna resultados (usada en select_menu) */
    public function cargar($script) {
        include_once "../core/db.php";
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($mysqli->connect_error) {
            die("❌ Error de conexión: " . $mysqli->connect_error);
        }

        return self::ejecuta_sql_rtn($script, DB_NAME, $mysqli, 1);
    }

    /** Consulta para ejecutar INSERT, UPDATE, DELETE */
    public function ejecutar($script) {
        include_once "./core/db.php";
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($mysqli->connect_error) {
            die("❌ Error de conexión: " . $mysqli->connect_error);
        }

        return self::ejecuta_sql($script, DB_NAME, $mysqli, 1);
    }

    /** Limpia strings para evitar inyecciones básicas */
    public function escapeString($inp) {
        if (is_array($inp))
            return array_map([$this, 'escapeString'], $inp);
        if (!empty($inp) && is_string($inp)) {
            return str_replace(['\\', "\0", "'", '"', "\x1a"], ['\\\\', '\\0', "\\'", '\\"', '\\Z'], $inp);
        }
        return $inp;
    }

    /** Ejecuta SQL que RETORNA datos (SELECT) */
    public function ejecuta_sql_rtn($sql = "", $bdd = "", $bdd_link = "", $op = 0) {
        $got = [];

        if ($sql != "") {
            mysqli_select_db($bdd_link, $bdd);
            mysqli_set_charset($bdd_link, "utf8");

            $result = @mysqli_query($bdd_link, $sql);

            if (!$result) {
                return [];
            }

            if ($op == 0) {
                $row = @mysqli_fetch_array($result);
                $a = $row[0];
            } elseif ($op == 2) {
                $row = @mysqli_fetch_array($result);
                for ($i = 0; $i < count($row); $i++) {
                    $got[0][$i] = $row[$i];
                }
                $a = $got;
            } else {
                $i = 0;
                if (mysqli_num_rows($result) > 0) {
                    $keys = array_keys(@mysqli_fetch_array($result));
                    @mysqli_data_seek($result, 0);
                    while ($row = @mysqli_fetch_array($result)) {
                        foreach ($keys as $speckey) {
                            $got[$i][$speckey] = $row[$speckey];
                        }
                        $i++;
                    }
                }
                $a = $got;
            }

            mysqli_free_result($result);
        }

        mysqli_close($bdd_link);
        return $a;
    }

    /** Ejecuta SQL que NO retorna datos (INSERT, UPDATE, DELETE) */
    public function ejecuta_sql($sql = "", $bdd = "", $bdd_link = "", $op = 0) {
        $consulta_sql = str_replace(
            ["\\", "\x00", "\n", "\r", "'", '"', "\x1a"],
            ["\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z"],
            $sql
        );

        $a = 0;
        $ruta = $_SERVER['SCRIPT_FILENAME'];
        $hoy = date('Y-m-d H:i:s');

        if ($sql != "") {
            mysqli_select_db($bdd_link, $bdd);
            mysqli_set_charset($bdd_link, "utf8");

            $result = mysqli_query($bdd_link, $sql);
            if (!$result) {
                // Aquí podrías agregar logging o auditoría si lo necesitas
                $a = 0;
            } else {
                if ($op == 0)
                    $a = mysqli_affected_rows($bdd_link);
                elseif ($op == 2)
                    $a = mysqli_insert_id($bdd_link);
                else
                    $a = 1;
            }
        }

        mysqli_close($bdd_link);
        return $a;
    }
}
?>
