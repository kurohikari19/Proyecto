<?php
session_start();
include("conexion.php");

if (isset($_GET['carrito'])) {
    $id_figura = intval($_GET['carrito']);

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    if (isset($_SESSION['carrito'][$id_figura])) {
        $_SESSION['carrito'][$id_figura]['cantidad'] += 1;
    } else {
        $sql = "SELECT * FROM figura WHERE id_figura = $id_figura";
        $result = mysqli_query($con, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['carrito'][$id_figura] = array(
                'id' => $row['id_figura'],
                'personaje' => $row['personaje'],
                'descripcion' => $row['descripcion'],
                'tipo' => $row['tipo'],
                'tamano' => $row['tamano'],
                'imagen' => $row['imagen'],
                'cantidad' => 1,
                'precio' => $row['precio'],
            );
        }
    }
}

header("Location: productosUsuario.php");
exit();
