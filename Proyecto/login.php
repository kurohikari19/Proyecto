<?php
session_start(); 
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $passwd = mysqli_real_escape_string($con, $_POST['passwd']);

    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($passwd === $user['passwd']) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['usuario_rol'] = $user['rol'];

            if ($user['rol'] === 'admin') {
                header("Location: productosAdmin.php");
            } else {
                header("Location: productosUsuario.php");
            }
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    mysqli_close($con);
}
?>
