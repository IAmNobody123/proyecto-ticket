<?php

if (isset($_POST['Cancelar'])) {
    $idTicket = $_POST["ticket"];
    $idProblema = $_POST["problema"];
    $idUsuario = $_POST["usuario"];
    echo $idTicket;
    echo $idProblema;
    echo $idUsuario;
    // /////////////////////////////////////////cancelar ticket
    $sqlCancelarTicket = "UPDATE ticket set estadoTicket = 'RAsignar' where idTicket = ?";
    $stmtCT = $conexion->prepare($sqlCancelarTicket);
    $stmtCT->bind_param("i", $idTicket);

    // // ///////////////////////////////////////// cambiar estado problema
    $sqlModificarProblema = "UPDATE problema set estadoProblema = 'entregado' where idProblema = ?";
    $stmtMP = $conexion->prepare($sqlModificarProblema);
    $stmtMP->bind_param("i", $idProblema);

    // /////////////////////////////////////////cambiar estado practicante
    $sqlModificarUsuario = "UPDATE usuario set tareaAsignada = 'libre' where idUsuario = ?";
    $stmtMU = $conexion->prepare($sqlModificarUsuario);
    $stmtMU->bind_param("i", $idUsuario);

    if($stmtCT ->execute()){
        $stmtMP->execute();
        $stmtMU->execute();
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Atención Cancelada',
                text: 'El ticket espera ser REASIGNADO!!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'tablaTicketsAsignados.php'; // Cambia esto por la URL a la que deseas redirigir
                }
            });
        </script>";
        $stmtMP->close();
        $stmtMU->close();
        $stmtCT->close();  

    }


    // if ($stmtCT->execute()) {
    //     ///////////////////////////////obtener id problema
    //     $stmtP->execute();
    //     $stmtP->bind_result($idProblema);
    //     ///////////////////////////////obtener id practicante
    //     echo 'problema :'.$idProblema;
    //     ///////////////////////////////verificar id problema y id practicante obtenido
    //     if ($stmtP->fetch()) {
    //         echo 'usuario :'.$idUsuario;

    //         $stmtU->execute();
    //         $stmtU->bind_result($idUsuario);
            
    //         if ($stmtU->fetch()) {
    //             $stmtMU->bind_param("i", $idUsuario);
    //             $stmtMU->execute();

    //             if($stmtMU->fetch()){
    //                 $stmtMP->bind_param("i", $idProblema);
    //                 $stmtMP->execute();
    //             }

    //             $verTicketsAsignados->fetch_object();

    //             echo "<script>
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'El ticket ha sido cancelado',
    //                     text: 'Por favor vuelva a reasignar el ticket.'
    //                 });
    //               </script>";
    //         }else{
    //             echo "<script>
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error',
    //                     text: 'No se encontró el practicante.'
    //                 });
    //               </script>";
    //         }



    //     } else {
    //         // Manejo del error si no se encuentra el idProblema
    //         echo "<script>
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error',
    //                     text: 'No se encontró el problema asociado al ticket.'
    //                 });
    //               </script>";
    //     }
    // }

}




?>