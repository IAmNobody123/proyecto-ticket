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


    if ($tipoImagen == "jpg" or $tipoImagen == "png" or $tipoImagen == "jpeg") {
        $registro = $conexion->query("insert into usuario(nombre, idLogin, password, direccionImagen, idOficina, idRol) values('$nombreUsuario','$idUsuario','$contraseñaUsuario','',$idOficina,$rolUsuario)");
        $idRegistro = $conexion->insert_id;
        //la ruta de la imagen falta arreglar
        $ruta = $directorio . $idRegistro . "." . $tipoImagen;
        $ruta2 = 'fotos/' . $idRegistro . "." . $tipoImagen;
        //almacenar la imagen

        if (move_uploaded_file($imagen, $ruta)) {
            echo "<div class='alert alert-success text-center'>imagen guardada con exito </div>";
        } else {
            echo "<div class='alert alert-danger text-center'>no se guardo la imagen!! </div>";
        }

        $actualizarImagen = $conexion->query("update usuario set direccionImagen ='$ruta2' where idUsuario = $idRegistro");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();

    } else {
        echo "<div class='alert alert-danger text-center '>no se acepta ese formato de imagen!! </div>";
    }
    ?>
    <!-- eliminar historial del formulario -->
    <script>
        history.replaceState(null, null, location.pathname);
    </script>
    <?php
}
?>