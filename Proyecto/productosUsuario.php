<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="productosUsuario.css">
        <title>Productos Usuario</title>
    </head>
    <body>
    
            <nav class="navegador">
                <div>
                    <a href="index.html">
                        <img src="assets/logo.png" alt="Logo" class="logo">
                    </a>
                
                    <details class="Menu">
                        <summary>Figuras</summary>
                        <li class = "submenu">
                            <a href="productosUsuario.php">Anime</a>
                        </li>
                        <li class = "submenu">
                            <a href="productosUsuario.php">Videojuegos</a>
                        </li>
                        <li class = "submenu">
                            <a href="productosUsuario.php">Películas</a>
                        </li>
                    </details>

                    <details class="Menu">
                        <summary>Cuenta</summary>
                        <li class = "submenu">
                            <a href="login.html">Login</a>
                        </li>
                        <li class = "submenu">
                            <a href="registro.html">Registro</a>
                        </li>
                        <li class="submenu">
                            <a href="logout.php">Log Out</a>
                        </li>
                    </details>
                    
                    <details class="Menu">
                        <summary>Quejas y sugerencias</summary>
                        <li class="submenu">
                            <a href="https://www.facebook.com/">Contactanos</a>
                        </li>
                    </details>

                    <a href="verCarrito.php">
                        <img src="assets/carrito.png" alt="Carrito" class="carrito">
                    </a>
                    
                </div>
            </nav>

        <h1>Productos Usuario</h1>

        <div class="container">
            <?php
                include ("conexion.php");
                $sql = mysqli_query($con,"SELECT * FROM figura");	
                while ($row = mysqli_fetch_array($sql)) {
            ?>
                <div class="Product">


                    <img src="imagenes/<?php echo $row['imagen']; ?>" alt="<?php echo $row['personaje']; ?>" width="100">
                    <h4><?php echo $row['personaje']; ?></h4>
                    <p><?php echo $row['descripcion']; ?></p>
                    <p><?php echo $row['tipo']; ?></p>
                    <p><?php echo $row['tamano']; ?></p>
                    <p>Stock: <?php echo $row['stock']; ?></p>
                    <p>Precio: $<?php echo $row['precio']; ?></p>
                    <form action="carrito.php" method="get">
                        <button type="submit" name="carrito" value="<?php echo $row['id_figura']; ?>">Agregar</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </body>
</html>
