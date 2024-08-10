<?php
$sqlQuery = "SELECT * FROM usuario WHERE 1=1";

if (isset($_POST["btnFiltrar"])) {
    if ($_POST["oficinaS"] != '') {
        $nroOficina = intval($_POST['oficinaS']);
        $sqlQuery .= ' and idOficina= ' . $nroOficina;
    }
    if($_POST["rolS"] != ''){
        $nroRol = intval($_POST['rolS']);
        $sqlQuery .= ' and idRol= '. $nroRol;
        
    }

}

// Para depurar

$sql = $conexion->query($sqlQuery);

if (!$sql) {
    echo "Error en la consulta: " . $conexion->error; // Para depurar
}
?>