<?php
    $server = "localhost";
    $database = "geekcave";
    $user = "root";
    $passwd = "1234";

    $con = mysqli_connect($server, $user, $passwd, $database);

    if ($con) {
        //echo "Conexion exitosa <br>";
    }else {
        echo "Error en la conexion";
    }
?>