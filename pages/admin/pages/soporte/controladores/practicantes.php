<?php

// Obtener las sedes
$sqlPracticantes = "SELECT idUsuario, nombre FROM usuario where  idRol = 2";
$resultPracticantes = $conexion->query($sqlPracticantes);

if ($resultPracticantes === false) {
    die("Error en la consulta de sedes: " . $conexion->error);
}
?>
