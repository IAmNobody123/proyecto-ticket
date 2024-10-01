<?php
if (!empty($_POST["editarU"])) {

    $idUsuario = $_POST["idUsuario"];
    $nombre = $_POST["nombre"];
    $idLogin = $_POST["idLogin"];
    $password = $_POST["password"];
    $ruta = $_POST["ruta"];
    $ruta2 = $ruta;

    if($ruta =="fotos/varon.jpg" or $ruta=="fotos/mujer.jpg"){
        $ruta = "";

    }

    $imagen= $_FILES["imagen"]["tmp_name"];
    $nombreImagen = $_FILES["imagen"]["name"];
    $tipoImagen = strtolower(pathinfo($nombreImagen,PATHINFO_EXTENSION));
    $directorio = "fotos/";

    if(is_file($imagen)){
        
        if($tipoImagen=="jpg" || $tipoImagen=="jpeg" || $tipoImagen=="png"){
            
            if (file_exists($ruta) && is_writable($ruta)) {
                if (unlink($ruta)) {
                    echo "<script>Swal.fire({
                        icon: 'success',
                        title: 'Archivo eliminado',
                        text: 'El archivo ha sido eliminado exitosamente.'
                    });</script>";
                } else {
                    echo "<script>Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo eliminar el archivo.'
                    });</script>";
                }
            } else {
                echo "<script>Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: 'El archivo no existe o no es escribible.'
                });</script>";
            }

            $ruta = $directorio.$idUsuario.".".$tipoImagen;

            if(move_uploaded_file($imagen,$ruta)){

                $editar = $conexion -> query("UPDATE usuario set direccionImagen = '$ruta',nombre = '$nombre', idLogin = '$idLogin' where idUsuario = $idUsuario ");

                if($editar == 1){
                    echo "<script>Swal.fire({
                        icon: 'success',
                        title: 'Imagen actualizada',
                        text: 'La imagen se logro actualizar'
                    });</script>";
                }
                else{
                    echo "<script>Swal.fire({
                        icon: 'warning',
                        title: 'Imagen actualizada',
                        text: 'La imagen se logro actualizar'
                    });</script>";
                }
            }
            else{
                echo "<script>Swal.fire({
                    icon: 'warning',
                    title: 'No se pudo subir la foto del usuario',
                    text: 'no se logro subir la foo al servidor'
                });</script>";
            }
             
        }
        else{
            echo "<script>Swal.fire({
                icon: 'warning',
                title: 'No se actualizo la foto del usuario',
                text: 'la foto debe estar en formato jpg, jpeg o png'
            });</script>";
        }

    }
    



/*
    echo "<script>Swal.fire({
        icon: 'warning',
        title: 'No se registró al usuario',
        text: 'El id del login ya está en uso, por favor escoge otro!!'
    });</script>";
*/    
?>

<script>
    history.replaceState(null,null,location.pathname);
</script>

<?php }
