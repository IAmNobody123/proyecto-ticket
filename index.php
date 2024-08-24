<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proyecto ticket</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="styleSheet" href="pages/login/index.css?g">
</head>

<body>
    <div class="wrapper">
        <form action="" method="post">

            <div class="imagen">
                <img src="pages/login/assets/fondo.png" alt="">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Ingresa tu usuario" required name="usuario">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="ingresa tu contraseña" required id="password" name="password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="showPassword">

                <label class="form-check-label" for="showPassword">Mostrar contraseña</label>
            </div>
            <?php
            include("conexion/conexion.php");
            include("controlador/controlador.php");
            ?>
            <button name="btnIngresar" class="btn" type="submit">
                Login
            </button>

        </form>
    </div>

    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            const passwordInput = document.getElementById('password');
            if (this.checked) {
                passwordInput.type = 'text'; // Cambia el tipo a texto para mostrar la contraseña
            } else {
                passwordInput.type = 'password'; // Cambia el tipo a password para ocultar la contraseña
            }
        });
    </script>
</body>

</html>