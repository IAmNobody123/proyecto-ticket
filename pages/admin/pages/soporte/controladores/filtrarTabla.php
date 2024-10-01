<?php
$verTicketsAsignados = "SELECT *,u.nombre as nombreS, u2.nombre as nombreU 
            FROM tipoProblema TP 
            INNER JOIN problema P ON TP.idTipoProblema = P.idTipoProblema 
            INNER JOIN usuario U ON P.idUsuario = U.idUsuario 
            INNER JOIN oficina O ON U.idOficina = O.idOficina 
            INNER JOIN sede S ON O.idSede = S.idSede 
            INNER JOIN ticket t ON t.idProblema = p.idProblema 
            INNER JOIN usuario U2 ON U2.idUsuario = t.idUsuario
            where  estadoTicket ='finalizado'";

if (isset($_POST["btnFiltrar"])) {
    if ($_POST["fecha"] != '') {
        $fechaAtencion = $_POST['fecha'];
        $verTicketsAsignados .= ' AND fechaAtencion = ' . $fechaAtencion;
    }
    if ($_POST["rolS"] != '') {
        $nroRol = intval($_POST['rolS']);
        $verTicketsAsignados .= ' AND u.idUsuario = ' . $nroRol;
    }
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Tabla actualizada',
        text: 'la tabla fue actualizada!!'
    });</script>";
}

// Ejecutar la consulta
$sqlVerTicketsA = $conexion->query($verTicketsAsignados);
// Verificar si la consulta se ejecutó correctamente
if (!$sqlVerTicketsA) {
    echo "Error en la consulta: " . $conexion->error; // Para depurar
    $sqlVerTicketsA = null; // Asegúrate de que $sql sea null si hay un error
}
?>