<?php

// Obtener los problemas 
$sqlTipoProblema = "SELECT idTipoProblema, nombreProblema FROM tipoProblema";
$resultTipoProblema = $conexion->query($sqlTipoProblema);

if ($resultTipoProblema === false) {
    die("Error en la consulta de sedes: " . $conexion->error);
}
?>