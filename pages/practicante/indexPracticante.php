<?php
session_start();
include("../../conexion/conexion.php");

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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
      <link rel="styleSheet" href="./style.css?z">
   </head>

   <body>
      <nav class="sidebar">
         <div class="text">Menu</div>
         <ul >
            <li>
               <a href="#" class="feat-btn paginaActual">Inicio</a>
            </li>
            <li >
               <a href="pages/listaTicket/listarTicket.php">tickets atendidos</a>
            </li>

         </ul>
      </nav>

      <div class="top-bar" id="welcomeA">
         <h1 id="welcomeAdm">Bienvenido <?= $usuarioName ?></h1>
         <div class="boxshadow" id="dropdownToggle">
            <img src='../admin/pages/addPracticante/fotos/<?= $usuarioId; ?>.jpg' alt="">
         </div>
         <div class="dropdown-menu" id="dropdownMenu">
            <a href="controladores/cerrarSesion.php">Cerrar sesión</a>
         </div>
      </div>

      <div class="crud">
         <?php
         $tareasUsuario = $conexion->query("SELECT * FROM tipoProblema TP 
                    INNER JOIN problema P ON TP.idTipoProblema = P.idTipoProblema 
                    INNER JOIN usuario U ON P.idUsuario = U.idUsuario 
                    INNER JOIN oficina O ON U.idOficina = O.idOficina 
                    INNER JOIN sede S ON O.idSede = S.idSede inner join ticket t on t.idProblema = p.idProblema where t.idUsuario = $usuarioId  and estadoTicket ='aceptado'");
         if ($problemaV = $tareasUsuario->fetch_object()) {
            ?>
            <p class="blink">Tienes una tarea pendiente: </p>
            <div class="card">
               <div class="headCard">
                  <?= $problemaV->nombreProblema ?>
               </div>
               <div class="bodyCard">
                  <p>En: <?= $problemaV->nombreOficina ?></p>

                  <p>asignado el: <?= $problemaV->fecha ?></p>

                  <p>a horas: <?= $problemaV->hora ?></p>
               </div>
               <div class="footerCard">
                  <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAtender"
                     data-id-problema="<?= $problemaV->idProblema ?>" data-nombre-solicitante="<?= $problemaV->nombre ?>"
                     data-sede="<?= $problemaV->nombreSede ?>" data-area="<?= $problemaV->nombreOficina ?>"
                     data-nombre-problema="<?= $problemaV->nombreProblema ?>"
                     data-descripcion-problema="<?= $problemaV->descripcionProblema ?>" data-hora="<?= $problemaV->fecha ?>"
                     data-fecha="<?= $problemaV->hora ?>" onclick="setIdTicket('<?= $problemaV->idTicket ?>')">Atender</a>
               </div>
            </div>
            <?php
         }
         ?>

         <div class="modal fade" id="modalAtender" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title text-center" id="myModalLabel">Registrar solucion del problema</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body " id="atener-body">
                     <form method="POST" action="">
                        <div class="atender-body">

                           <!-- Campo oculto para el idProblema -->
                           <input type="hidden" name="idTicket" id="idTicket">
                           <p id="ModalSolicitante"></p>
                           <p id="ModalFecha"></p>
                           <p id="ModalHora"></p>
                           <p id="ModalSede"></p>
                           <p id="ModalArea"></p>

                           <label for="selreq"><strong>Selecciona un requerimiento usado</strong></label>
                           <select name="selectorReq" id="selreq" class="select">
                              <option value="ninguna">Seleccionar</option>
                              <option value="hardware">hardware</option>
                              <option value="software">software</option>
                              <option value="internet">internet</option>
                              <option value="perifericos">perifericos</option>
                              <option value="conexiones">conexiones</option>
                           </select>
                           <div class="solucion">

                              <label for="descrip"><strong>Registre la solucion: </strong></label>
                              <textarea type="text" name="descrip" required id="inputText" rows="4"></textarea>
                           </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                           <button type="submit" name="submitAtenderP" class="btn btn-secondary me-2">Atender</button>
                           <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
         crossorigin="anonymous"></script>
      <script>
         function setIdTicket(idTicket) {
            document.getElementById('idTicket').value = idTicket;
         }

         // JavaScript para mostrar/ocultar el menú al hacer clic en el ícono
         var dropdownToggle = document.getElementById('dropdownToggle');
         var dropdownMenu = document.getElementById('dropdownMenu');

         dropdownToggle.addEventListener('click', function () {
            dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
         });

         // Cerrar el menú si se hace clic fuera de él
         document.addEventListener('click', function (event) {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
               dropdownMenu.style.display = 'none';
            }
         });

         $('#modalAtender').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal

            var idProblemas = button.data('id-problema');
            var nombreSolicitante = button.data('nombre-solicitante');
            var fechaProblema = button.data('fecha');
            var horaProblema = button.data('hora');
            var sede = button.data('sede');
            var area = button.data('area');
            var nombreProblema = button.data('nombre-problema');
            var descripcionProblema = button.data('descripcion-problema');

            // Actualizar el contenido del modal
            var modal = $(this);
            modal.find('#modalDetalleLabel').html('Detalle del problema NRO:' + idProblemas);
            modal.find('#ModalSolicitante').html('<b>Solicitante: </b>' + nombreSolicitante);
            modal.find('#ModalFecha').html('<b>Fecha de la solicitud: </b>' + fechaProblema);
            modal.find('#ModalHora').html('<b>Hora de la solicitud: </b>' + horaProblema);
            modal.find('#ModalSede').html('<b>Sede:</b> ' + sede);
            modal.find('#ModalArea').html('<b>Area: </b>' + area);
            modal.find('#ModalNombre').html('<b>Nombre del Problema: </b>' + nombreProblema);
            modal.find('#ModalDescripcion').html('<b>Descripcion del problema: </b>' + descripcionProblema);

         });
      </script>

   </body>
   <?php
} else {
   header("Location: ../../index.php");
}
?>

</html>