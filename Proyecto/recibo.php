<?php
session_start();
require 'libs/vendor/autoload.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;

// Leer el JSON enviado
$input = json_decode(file_get_contents("php://input"), true);
$emailDestino = $input['email'] ?? '';

// Validar email
if (!filter_var($emailDestino, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'msg' => 'Correo inválido']);
    exit;
}

// Validar carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo json_encode(['status' => 'error', 'msg' => 'Carrito vacío']);
    exit;
}

// Generar HTML para el PDF
$html = '<h1>Detalles de tu compra</h1><table border="1" cellpadding="10"><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr>';
$total = 0;

foreach ($_SESSION['carrito'] as $producto) {
    $subtotal = $producto['precio'] * $producto['cantidad'];
    $total += $subtotal;
    $html .= '<tr>
                <td>' . htmlspecialchars($producto['personaje']) . '</td>
                <td>' . $producto['cantidad'] . '</td>
                <td>$' . number_format($producto['precio'], 2) . '</td>
                <td>$' . number_format($subtotal, 2) . '</td>
              </tr>';
}
$html .= '<tr><td colspan="3"><b>Total</b></td><td><b>$' . number_format($total, 2) . '</b></td></tr></table>';

// Generar PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$pdf = $dompdf->output();

// Guardar PDF en la misma carpeta
$pdfPath = __DIR__ . '/recibo.pdf';
file_put_contents($pdfPath, $pdf);

// Enviar correo
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'claudio.prueba.paypal@gmail.com';
    $mail->Password = 'bfgowhvzfmlomupo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('claudio.prueba.paypal@gmail.com', 'GeekCave');
    $mail->addAddress($emailDestino);
    $mail->Subject = 'Recibo de compra';
    $mail->Body = 'Adjunto encontrarás tu recibo de compra. ¡Gracias!';
    $mail->addAttachment($pdfPath, 'recibo.pdf');

    $mail->send();
    unlink($pdfPath); // Limpieza
    echo json_encode(['status' => 'ok']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'msg' => $mail->ErrorInfo]);
}
