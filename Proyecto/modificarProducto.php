<?php
session_start();
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM figura WHERE id_figura='$id'";
    $resultado = mysqli_query($con, $query);
    $producto = mysqli_fetch_array($resultado);

    if (!$producto) {
        echo "Producto no encontrado";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
    $tipo = $_POST['tipo'] ?? '';
    $tamano = $_POST['tamano'] ?? '';
    $personaje = $_POST['personaje'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0;

    $query_antes = "SELECT * FROM figura WHERE id_figura='$id'";
    $resultado_antes = mysqli_query($con, $query_antes);
    $datos_antes = mysqli_fetch_array($resultado_antes);

    $nombreImagen = $datos_antes['imagen']; // imagen actual por defecto
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $nombreImagenSubida = basename($_FILES['imagen']['name']);
        $rutaImagen = 'imagenes/' . $nombreImagenSubida;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            $nombreImagen = $nombreImagenSubida;
        } else {
            echo "Error al mover la imagen al servidor.";
        }
    }

    $sql = "UPDATE figura 
            SET stock='$stock', tipo='$tipo', tamano='$tamano', personaje='$personaje', 
                descripcion='$descripcion', precio='$precio', imagen='$nombreImagen' 
            WHERE id_figura='$id'";

    $resultado = mysqli_query($con, $sql);

    if ($resultado) {
        $usuario_id = $_SESSION['usuario_id'] ?? 0;
        $consulta = mysqli_real_escape_string($con, $sql);

        $contraconsulta = "INSERT INTO figura (id_figura, stock, tipo, tamano, personaje, descripcion, precio, imagen) VALUES (" .
            $datos_antes['id_figura'] . ", " .
            $datos_antes['stock'] . ", '" .
            mysqli_real_escape_string($con, $datos_antes['tipo']) . "', '" .
            mysqli_real_escape_string($con, $datos_antes['tamano']) . "', '" .
            mysqli_real_escape_string($con, $datos_antes['personaje']) . "', '" .
            mysqli_real_escape_string($con, $datos_antes['descripcion']) . "', " .
            $datos_antes['precio'] . ", '" .
            mysqli_real_escape_string($con, $datos_antes['imagen']) . "')";

        $contraconsulta = mysqli_real_escape_string($con, $contraconsulta);
        $fechayhora = date('Y-m-d H:i:s');

        $bitacora_sql = "INSERT INTO bitacora (usuario, consulta, contraconsulta, fechayhora)
                         VALUES ('$usuario_id', '$consulta', '$contraconsulta', '$fechayhora')";
        mysqli_query($con, $bitacora_sql);

        header("Location: modificarProducto.php?id=$id");

        exit();
    } else {
        echo "Error al modificar: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="registroProductos.css">
</head>
<body>
<nav class="navegador">
    <div style="text-align: center;">
        <img src="assets/logo.png" alt="Logo" class="logo">
        <a href="registroProductos.html" class="Menu">Registro productos</a>
        <a href="productosAdmin.php" class="Menu">Productos</a>
        <a href="logout.php" class="Menu">Cerrar sesión</a>
    </div>
</nav>

<form action="" method="POST" enctype="multipart/form-data">
    <section>
        <h1>Modificar Producto</h1>
        <input type="hidden" name="id" value="<?php echo $producto['id_figura']; ?>">

        <div class="form-element">
            <label>Personaje</label>
            <input type="text" name="personaje" value="<?php echo htmlspecialchars($producto['personaje']); ?>" required />
        </div>

        <div class="form-element">
            <label>Categoria</label>
            <input type="text" name="tipo" value="<?php echo htmlspecialchars($producto['tipo']); ?>" required />
        </div>

        <div class="form-element">
            <label>Descripcion</label>
            <input type="text" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion']); ?>" required />
        </div>

        <div class="form-element">
            <label>Tamaño</label>
            <input type="text" name="tamano" value="<?php echo htmlspecialchars($producto['tamano']); ?>" required />
        </div>

        <div class="form-element">
            <label>Stock</label>
            <input type="text" name="stock" value="" required />
        </div>

        <div class="form-element">
            <label>Precio</label>
            <input type="text" name="precio" value="" required />
        </div>

        <div class="form-element">
            <label for="imagen">Imagen (deja vacío si no deseas cambiarla)</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" />
        </div>

        <div class="form-element">
            <img src="imagenes/<?php echo htmlspecialchars($producto['imagen']); ?>" width="150" alt="Imagen actual">
        </div>

        <button type="submit">Modificar</button>
    </section>
</form>
</body>
</html>
