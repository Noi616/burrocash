<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit;
}

require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_FILES['archivo']) && isset($_POST['destinatario'])) {
    $destinatario = $_POST['destinatario'];
    $archivoTmp = $_FILES['archivo']['tmp_name'];
    $nombreArchivo = $_FILES['archivo']['name'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'osvaldoc297@gmail.com';
        $mail->Password = 'mihg eplp saqy raja';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('osvaldoc297@gmail.com', 'Burrocash');
        $mail->addAddress($destinatario);

        if (file_exists($archivoTmp)) {
            $mail->addAttachment($archivoTmp, $nombreArchivo);
        } else {
            $_SESSION['mensaje'] = 'El archivo no existe.';
            $_SESSION['tipo_mensaje'] = 'error';
            header("Location: ../reportes.php");
            exit;
        }

        $mail->isHTML(true);
        $mail->Subject = 'Compartir Archivo Exportado';
        $mail->Body = '<h3>Hola,</h3><p>Te comparto el archivo exportado desde nuestro sistema.</p>';

        $mail->send();
        $_SESSION['mensaje'] = "Correo enviado con éxito a $destinatario";
        $_SESSION['tipo_mensaje'] = 'exito';
    } catch (Exception $e) {
        $_SESSION['mensaje'] = "Error al enviar el correo: {$mail->ErrorInfo}";
        $_SESSION['tipo_mensaje'] = 'error';
    }
} else {
    $_SESSION['mensaje'] = 'No se recibió el archivo o el correo del destinatario.';
    $_SESSION['tipo_mensaje'] = 'error';
}
header("Location: ../reportes.php");
exit;
?>
