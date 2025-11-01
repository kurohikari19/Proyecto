<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="productosAdmin.css">
        <title>Productos Administrador</title>
    </head>

    <nav class="navegador">
        <div>
            <a href="index.html" class="Menu">
                <img src="assets/logo.png" alt="Logo" class="logo">
            </a>
            <a href="registroProductos.html" class="Menu">Registro productos</a>
            <a href="productosAdmin.php" class="Menu">Productos</a>
            <a href="logout.php" class="Menu">Cerrar sesión</a>
            <a href="bitacora.php" class="Menu">Bitácora</a>
        </div>
    </nav>

    <body>
        <div class="container">
            
            <?php
                include("conexion.php");
                $sql = mysqli_query($con, "SELECT * FROM figura");
            ?>

            <div class="table-container">
                <h1>Productos Administrador</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID Figura</th>
                            <th>Stock</th>
                            <th>Tipo</th>
                            <th>Tamaño</th>
                            <th>Personaje</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td><?php echo $row['id_figura']; ?></td>
                                <td><?php echo $row['stock']; ?></td>
                                <td><?php echo $row['tipo']; ?></td>      
                                <td><?php echo $row['tamano']; ?></td>
                                <td><?php echo $row['personaje']; ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                                <td><?php echo $row['precio']; ?></td>
                                <td>
                                    <img src="imagenes/<?php echo $row['imagen']; ?>" alt="<?php echo $row['personaje']; ?>" width="100">
                                </td>
                                <td>
                                    <form action="eliminarProducto.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id_figura']; ?>">
                                        <button type="submit">Eliminar</button>
                                    </form>
                                    <form action="modificarProducto.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id_figura']; ?>">
                                        <button type="submit">Modificar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
