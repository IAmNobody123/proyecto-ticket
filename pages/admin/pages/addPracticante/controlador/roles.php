<?php

// Obtener las sedes
$sqlRoles = "SELECT idRol , nombreRol FROM rol";
$resultRol = $conexion->query($sqlRoles);

if ($resultRol === false) {
    die("Error en la consulta de roles: " . $conexion->error);
}

$sqlOficina = "SELECT idOficina , nombreOficina FROM oficina";
$resultOficina = $conexion->query($sqlOficina);

if ($resultOficina === false) {
    die("Error en la consulta de roles: " . $conexion->error);
}

?>