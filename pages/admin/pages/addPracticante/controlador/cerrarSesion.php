<?php
// Inicia la sesión si no está iniciada
session_start();
session_unset();
session_destroy();

// Redirige a la página de inicio de sesión u otra página deseada
header("Location: ../../../../../index.php"); // Cambia index.php por la página a la que quieras redirigir
exit;

