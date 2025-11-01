<?php
session_start();

if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="verCarrito.css">
    <script src="https://www.paypal.com/sdk/js?client-id=ATjhZ9UhH2pnh4iNDj1ktZvkVOZDzLEGDI-uEesrAgZBHjf0OE-65didB7x0iIFHtLegJAa7awXL6Kz2&currency=MXN"></script>
</head>
<body>

    <!-- NAV -->
    <nav class="navegador">
        <div>
            <a href="index.html"><img src="assets/logo.png" alt="Logo" class="logo"></a>
            <details class="Menu">
                <summary>Figuras</summary>
                <li class="submenu"><a href="productosUsuario.php">Anime</a></li>
                <li class="submenu"><a href="productosUsuario.php">Videojuegos</a></li>
                <li class="submenu"><a href="productosUsuario.php">Películas</a></li>
            </details>
            <details class="Menu">
                <summary>Cuenta</summary>
                <li class="submenu"><a href="login.html">Login</a></li>
                <li class="submenu"><a href="registro.html">Registro</a></li>
                <li class="submenu"><a href="logout.php">Log Out</a></li>
            </details>
            <details class="Menu">
                <summary>Quejas y sugerencias</summary>
                <li class="submenu"><a href="https://www.facebook.com/">Contáctanos</a></li>
            </details>
            <a href="verCarrito.php"><img src="assets/carrito.png" alt="Carrito" class="carrito"></a>
        </div>
    </nav>

    <!-- CARRITO -->
    <div class="container">
        <h1>Carrito</h1>
        <div class="table-container">
            <table>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Tamaño</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
                <?php
                $total = 0;
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $producto) {
                        echo "<tr>";
                        echo "<td><img src='imagenes/" . $producto['imagen'] . "' width='60'></td>";
                        echo "<td>" . $producto['personaje'] . "</td>";
                        echo "<td>" . $producto['descripcion'] . "</td>";
                        echo "<td>" . $producto['tipo'] . "</td>";
                        echo "<td>" . $producto['tamano'] . "</td>";
                        echo "<td>" . $producto['cantidad'] . "</td>";
                        $subtotal = $producto['precio'] * $producto['cantidad'];
                        echo "<td>$" . number_format($subtotal, 2) . "</td>";
                        echo "<td><a href='verCarrito.php?eliminar=" . $producto['id'] . "' class='eliminar'>Eliminar</a></td>";
                        echo "</tr>";
                        $total += $subtotal;
                    }
                } else {
                    echo "<tr><td colspan='8'>El carrito está vacío.</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="total">
            <h2>Total: $<?php echo number_format($total, 2); ?></h2>

            <?php if ($total > 0): ?>
                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <div id="paypal-button-container"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($total > 0): ?>
    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay',
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo number_format($total, 2, '.', ''); ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(detalles) {
                    const email = detalles.payer.email_address;

                    fetch('recibo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ email: email })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'ok') {
                            window.location.href = "gracias.html";
                        } else {
                            alert('Error al enviar recibo: ' + data.msg);
                        }
                    });
                });
            },
            onCancel: function(data) {
                console.log('Pago cancelado');
            }
        }).render('#paypal-button-container');
    </script>
    <?php endif; ?>
</body>
</html>
