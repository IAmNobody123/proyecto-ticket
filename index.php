<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proyecto ticket</title>
    <link rel="styleSheet" href="pages/login/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <form action="" method = "post">
            <h1>login</h1>
                
            <div class="input-box">
                <input type="text" placeholder="Username" required name="usuario">
                <i class='bx bxs-user' ></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" required name="password">
                <i class='bx bxs-lock-alt' ></i>
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
</body>
</html>