<?php

if (!empty($_POST["btnregistrar"])) {
    // Datos del formulario
    $nombreUsuario = $_POST["nombreUsuario"];
    $idUsuario = $_POST["idUsuario"];
    $contraseñaUsuario = $_POST["contraseñaUsuario"];
    $rolUsuario = $_POST["roles"];
    $idOficina = $_POST["oficina"];
    $genero = $_POST['sexo'];

    // Inicializar variables de imagen
    $imagen = null;
    $ruta = null;
    $ruta2 = null;
    $tipoImagen = null;

    if (!empty($_FILES["imagen"]["name"])) {
        // Imagen
        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = $_FILES["imagen"]["name"];
        $tipoImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
        $sizeImage = $_FILES["imagen"]["size"];
        $directorio = "./fotos/";
    } else {
        // Asignar imagen predeterminada según el género
        if ($genero == "masculino") {
            $ruta = "./fotos/varon.jpg"; // Ruta de la imagen predeterminada para varón
            $ruta2 = 'fotos/varon.jpg';
        } else if ($genero == "femenino") {
            $ruta = "./fotos/mujer.jpg"; // Ruta de la imagen predeterminada para mujer
            $ruta2 = 'fotos/mujer.jpg';
        }
    }

    // Verificar usuario
    $stmtVerfUser = $conexion->prepare("SELECT COUNT(*) FROM usuario WHERE idLogin = ?");
    $stmtVerfUser->bind_param("s", $idUsuario);
    $stmtVerfUser->execute();
    $stmtVerfUser->bind_result($count);
    $stmtVerfUser->fetch();
    $stmtVerfUser->close();

    if ($count > 0) {
        echo "<script>Swal.fire({
                icon: 'warning',
                title: 'No se registró al usuario',
                text: 'El id del login ya está en uso, por favor escoge otro!!'
            });</script>";
    } else {
        if ($tipoImagen == "jpg" || $tipoImagen == "png" || $tipoImagen == "jpeg" || $ruta) {
            if ($imagen) {
                $registro = $conexion->query("INSERT INTO usuario(nombre, idLogin, password, direccionImagen, idOficina, idRol) VALUES('$nombreUsuario','$idUsuario','$contraseñaUsuario','','$idOficina','$rolUsuario')");
                $idRegistro = $conexion->insert_id;
                $ruta = $directorio . $idRegistro . "." . $tipoImagen;
                $ruta2 = 'fotos/' . $idRegistro . "." . $tipoImagen;

                // Almacenar la imagen
                if (move_uploaded_file($imagen, $ruta)) {
                    echo "<div class='alert alert-success text-center'>Imagen guardada con éxito </div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>No se guardó la imagen!! </div>";
                }
            } else {
                // Si no se subió imagen, usar la ruta de la imagen predeterminada
                $registro = $conexion->query("INSERT INTO usuario(nombre, idLogin, password, direccionImagen, idOficina, idRol) VALUES('$nombreUsuario','$idUsuario','$contraseñaUsuario','$ruta2','$idOficina','$rolUsuario')");
                $idRegistro = $conexion->insert_id;
            }

            // Actualizar la imagen en la base de datos
            $actualizarImagen = $conexion->query("UPDATE usuario SET direccionImagen ='$ruta2' WHERE idUsuario = $idRegistro");
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'Se registró al nuevo usuario!!'
            });</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'No se registró al usuario',
                text: 'El formato de imagen no es válido!!!'
            });</script>";
        }
    }
?>
<!-- Eliminar historial del formulario -->
<script>
    history.replaceState(null, null, location.pathname);
</script>
<?php
}
?>