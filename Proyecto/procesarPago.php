<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['carrito'])) {
    header("Location: verCarrito.php");
    exit;
}

$total = isset($_GET['total']) ? floatval($_GET['total']) : 0.00;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago con PayPal</title>

    <script src="https://www.paypal.com/sdk/js?client-id=ATjhZ9UhH2pnh4iNDj1ktZvkVOZDzLEGDI-uEesrAgZBHjf0OE-65didB7x0iIFHtLegJAa7awXL6Kz2&currency=MXN"></script>
</head>
<body>
    <div id="paypal-button-container"></div>

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
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
