<?php
session_start();
include 'conexion.php';

$stock = $_POST['stock'];
$tipo = $_POST['tipo'];
$tamano = $_POST['tamano'];
$personaje = $_POST['personaje'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

// Verificamos si se subió correctamente la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $nombreImagen = basename($_FILES['imagen']['name']);
    $rutaImagen = 'imagenes/' . $nombreImagen;

    // Movemos la imagen a la carpeta "imagenes"
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        // Insertamos en la base de datos la ruta o el nombre de la imagen
        $sql = "INSERT INTO figura (stock, tipo, tamano, personaje, descripcion, precio, imagen) 
                VALUES ('$stock', '$tipo', '$tamano', '$personaje', '$descripcion', '$precio', '$nombreImagen')";

        if (mysqli_query($con, $sql)) {
            $usuario = $_SESSION['usuario_id'];

            // Guardamos la consulta ejecutada en la bitácora
            $consulta = mysqli_real_escape_string($con, $sql); // prevenir errores en comillas
            $bitacora = "INSERT INTO bitacora (usuario, consulta) VALUES ('$usuario', '$consulta')";
            mysqli_query($con, $bitacora);

            header("Location: registroProductos.html");
            exit;
        } else {
            echo "Error al insertar en la base de datos: " . mysqli_error($con);
        }
    } else {
        echo "Error al mover la imagen a la carpeta destino.";
    }
} else {
    echo "No se subió la imagen o hubo un error: " . $_FILES['imagen']['error'];
}

mysqli_close($con);
?>
