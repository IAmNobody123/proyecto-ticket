<?php

if (!empty($_POST["btnregistrar"])) {
    //datos del formulario
    $nombreUsuario = $_POST["nombreUsuario"];
    $idUsuario = $_POST["idUsuario"];
    $contraseñaUsuario = $_POST["contraseñaUsuario"];
    $rolUsuario = $_POST["roles"];
    $idOficina = $_POST["oficina"];

    //imagen
    $imagen = $_FILES["imagen"]["tmp_name"];
    $nombreImagen = $_FILES["imagen"]["name"];
    $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
    $sizeImage = $_FILES["imagen"]["size"];
    $directorio = "./fotos/";

    //verificar usuario
    $stmtVerfUser = $conexion->prepare("SELECT COUNT(*) FROM usuario WHERE idLogin = ?");
    $stmtVerfUser->bind_param("s", $idUsuario);
    $stmtVerfUser->execute();
    $stmtVerfUser->bind_result($count);
    $stmtVerfUser->fetch();
    $stmtVerfUser->close();
    if ($count > 0) {
        echo "<script>Swal.fire({
                icon: 'warning',
                title: 'No se registro al usuario',
                text: 'El id del login ya esta en uso, por favor escoge otro!!'
            });</script>";
    } else {

        if ($tipoImagen == "jpg" or $tipoImagen == "png" or $tipoImagen == "jpeg") {
            $registro = $conexion->query("insert into usuario(nombre, idLogin, password, direccionImagen, idOficina, idRol) values('$nombreUsuario','$idUsuario','$contraseñaUsuario','',$idOficina,$rolUsuario)");
            $idRegistro = $conexion->insert_id;
            //la ruta de la imagen falta arreglar
            $ruta = $directorio . $idRegistro . "." . $tipoImagen;
            $ruta2 = 'fotos/' . $idRegistro . "." . $tipoImagen;
            //almacenar la imagen

            if (move_uploaded_file($imagen, $ruta)) {
                echo "<div class='alert alert-success text-center'>imagen guardada con exito </div>";
                echo "<script>Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'Se registro al nuevo usuario!!'
            });</script>";
            } else {
                echo "<div class='alert alert-danger text-center'>no se guardo la imagen!! </div>";
            }

            $actualizarImagen = $conexion->query("update usuario set direccionImagen ='$ruta2' where idUsuario = $idRegistro");
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'Se registro al nuevo usuario!!'
            });</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();


        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'No se registro al usuario',
                text: 'el formato de imagen!!!'
            });</script>";
        }
    }
    ?>
    <!-- eliminar historial del formulario -->
    <script>
        history.replaceState(null, null, location.pathname);
    </script>
    <?php
}
?>