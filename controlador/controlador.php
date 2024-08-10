<?php
//la condicional verifica si el boton ha sido presionado
if (empty($_POST["btnIngresar"])) {
    //verifica que los campos usuario y contraseña no esten vacios
    if (empty($_POST["usuario"]) && empty($_POST["password"])) {
    } else {
        //Si los campos no están vacíos, asigna los valores de usuario y contraseña a variables PHP.
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        //Realiza dos consultas SQL a la tabla usuarios, en busca del roll
        //0=administrador |||||||| 1=practicante 

        $sqlAdmin = $conexion->query("select * from usuario where
        idLogin = '$usuario' and password='$password' and idRol = 1");
        $sqlPracticante = $conexion->query("select * from usuario where
        idLogin = '$usuario' and password='$password' and idRol = 2");
        $sqlComun = $conexion->query("select * from usuario where
        idLogin = '$usuario' and password='$password' and idRol = 3");

        //verifica el id y la contraseña
        if ($datos = $sqlAdmin->fetch_object()) {
            session_start();
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION["id"]= $datos->idUsuario;

            //si el id, contraseña son correctos y el roll es 1, nos manda a la pagina de admin
            header("location:pages/admin/index.php");
        } else if ($datos = $sqlPracticante->fetch_object()) {
            session_start();
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION["id"]= $datos->idUsuario;

            //si el id, contraseña son correctos y el roll es 2, nos manda a la pagina de practicante
            header("location:pages/practicante/indexPracticante.php");
        } else if ($datos = $sqlComun->fetch_object()) {
            session_start();
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION["id"]= $datos->idUsuario;
            //si el id, contraseña son correctos y el roll es 3, nos manda a la pagina de usuario Comun
            header("location:pages/usuariosComun/indexComun.php");
        } else {
            //si los campos no son correctos nos devuelve una advertencia
            echo '<div class="alert alert-danger"> LOS CAMPOS ESTAN INCORRECTOS</div>';
        }
    }
}


?>