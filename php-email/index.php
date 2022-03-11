<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


$name = $_POST['field-name'];
$email = trim($_POST['field-email']);
$message = $_POST['field-message'];

$from = $email;
$to = "dy@dyvaz.com";
$subject = "testando email php no mailhog";

try {
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;


    $mail->isSMTP();
    $mail->Host       = "localhost";
    $mail->Port       = 1025;
    $mail->SMTPAuth = true;

    $mail->setFrom($from, $name);
    $mail->addAddress($to);

    $mail->Subject = 'Testando Mailhog -php';
    $mail->Body = $message;


    $mail->Send();


    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {

    echo "Erro: E-mail não enviado!";
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Formulário de contato</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="icon" href="img/icon-page.png">
</head>

<body>
    <div class="form-geral">
        <div>

            <form action="/" method="post">
                <div>
                    <label for="field-name">
                        <img src="img/icon.png" alt="icone de perfil" />
                    </label>
                    <input id="field-name" type="text" name="field-name" placeholder="  Name" />
                </div>
                <div>
                    <label for="field-email">
                        <img src="img/email.png" alt="icone de email" />
                    </label>
                    <input type="email" id="field-email" name="field-email" placeholder="  Email" />
                </div>

                <label for="field-message">
                    <img src="img/escrita.png" alt="icone de escrita" />
                </label>

                <textarea name="field-message" id="field-message" class="field-message" placeholder=" Mensagem" cols="39" rows="5"></textarea>
                <div>
                    <button name="botton-submit" id="botton-submit" class="botton-submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>