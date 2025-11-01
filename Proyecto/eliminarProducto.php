<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Obtener el producto antes de eliminarlo
    $query = mysqli_query($con, "SELECT * FROM figura WHERE id_figura='$id'");
    $producto = mysqli_fetch_assoc($query);

    if (!$producto) {
        echo "Producto no encontrado";
        exit();
    }

    // Ejecutar eliminación
    $sql = mysqli_query($con, "DELETE FROM figura WHERE id_figura='$id'");

    if ($sql) {
        // Registro en bitácora
        $usuario = $_SESSION['usuario_id'];
        $consulta = "DELETE FROM (id_figura, stock, tipo, tamano, personaje, descripcion, precio, imagen) VALUES (
            {$producto['id_figura']}, {$producto['stock']}, '{$producto['tipo']}', '{$producto['tamano']}',
            '{$producto['personaje']}', '{$producto['descripcion']}', {$producto['precio']}, '{$producto['imagen']}')";
        $contraconsulta = "INSERT INTO figura (id_figura, stock, tipo, tamano, personaje, descripcion, precio, imagen) VALUES (
            {$producto['id_figura']}, {$producto['stock']}, '{$producto['tipo']}', '{$producto['tamano']}',
            '{$producto['personaje']}', '{$producto['descripcion']}', {$producto['precio']}, '{$producto['imagen']}')";

        mysqli_query($con, "INSERT INTO bitacora (usuario, consulta, contraconsulta)
            VALUES ('$usuario', \"$consulta\", \"$contraconsulta\")");

        header("Location: productosAdmin.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
