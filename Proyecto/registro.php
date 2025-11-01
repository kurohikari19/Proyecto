<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$passwd = $_POST['passwd'];
$rol = 'usuario';

$sql = mysqli_query($con, "INSERT INTO usuarios (nombre, email, passwd, rol) 
VALUES ('$nombre', '$email', '$passwd', '$rol')");

if ($sql) {
    echo "Usuario agregado correctamente";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
