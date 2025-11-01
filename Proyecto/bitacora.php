<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}

$sql = "SELECT b.*, u.nombre AS nombre_usuario
        FROM bitacora b
        LEFT JOIN usuarios u ON b.usuario = u.id
        ORDER BY b.fechayhora DESC";

$resultado = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bitácora de Administradores</title>
    <link rel="stylesheet" href="bitacora.css">
</head>
<body>
    <h1>Bitácora</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Consulta</th>
                <th>Contraconsulta</th>
                <th>Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre_usuario']); ?></td>
                    <td><pre><?php echo htmlspecialchars($fila['consulta']); ?></pre></td>
                    <td><pre><?php echo htmlspecialchars(!empty($fila['contraconsulta']) ? $fila['contraconsulta'] : 'No hay contraconsulta'); ?></pre></td>
                    <td><?php echo $fila['fechayhora']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
