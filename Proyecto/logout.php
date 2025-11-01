<?php
    session_start();
    
    unset($_SESSION['usuario_id']);
    unset($_SESSION['usuario_nombre']);
    unset($_SESSION['usuario_rol']);

    header("Location: index.html");
    exit();
?>
