<?php
session_start();
include ("../../conexion/conexion.php");
if (isset($_SESSION["nombre"])) {
   $usuarioName = $_SESSION["nombre"];
   $usuarioId = $_SESSION["id"];
   ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>practicante</title>
      <link rel="styleSheet" href="./style.css?b">

   </head>

   <body>
      <header class="header">
         <div class="container">
            <div class="btn-menu">
               <label for="btn-menu">☰</label>
            </div>
            <div class="logo">
               <h1>Opciones</h1>
            </div>
         </div>
      </header>
      
      <div class="capa"></div>

   <input type="checkbox" id="btn-menu">
   <div class="container-menu">
      <div class="cont-menu">
         <nav>
            <a href="pages/crearTicket/listarProblemas.php">Tickets encargados</a>
            <a href="#">Solucion a tickets</a>
            <a href="#">Ver todos los tickets</a>
         </nav>
         <label for="btn-menu">✖️</label>
      </div>
   </div>
   
   <div class="contenido">
      hola mundo
   </div>
</body>
<?php
} else {
   header("Location: ../../index.php");
}
?>

</html>