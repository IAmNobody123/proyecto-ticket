<?php
/* variable para crear conexion a la bd
por defecto estamos trabajando en el entorno local : localhost
el usuario por defecto: root
la contraseña no esta habilitada : ""
la base de datos se llama :  "tickets"
el puerto por defecto es el 3306, ya no se especifica

*/

$conexion = new mysqli("localhost","root","","ticket");
// $conexion = new mysqli("sql307.infinityfree.com","if0_37185371","314Ensa","if0_37185371_XXX");
?>