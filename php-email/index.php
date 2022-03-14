<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


$name = isset($_POST['field-name']) ? $_POST['field-name'] : '';
$email = isset($_POST['field-email']) ? $_POST['field-email'] : '';
$message = isset($_POST['field-message']) ? $_POST['field-message'] : '';


$erro = false;

if ((!isset($email) || !filter_var(trim($email), FILTER_VALIDATE_EMAIL)) && $erro == false) {
    echo '   Envie um email válido.  ';
    $erro = true;
}

if ((!filter_var(trim($name)) || !filter_var(trim($message))) && $erro == false) {
    echo ' campos vazios  ';
    $erro = true;
}

$from = $email;
$to = "dy@dyvaz.com";
$subject = "testando email php no mailhog";


try {
    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = "localhost";
    $mail->Port       = 1025;
    $mail->SMTPAuth = true;

    $mail->setFrom($from, $name);
    $mail->addAddress($to);

    $mail->Subject = 'Testando Mailhog -php';
    $mail->Body = $message;


    $mail->Send();
    if ($erro) {
        echo $erro;
    } else {
        header('Location: index.php');
        exit();
    }

    //echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {

    // echo "Erro: E-mail não enviado!";
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
                    <input id="field-name" value="<?php echo $_POST['field-name'] ?>" type="text" name="field-name" placeholder="  Name" />
                </div>
                <div>
                    <label for="field-email">
                        <img src="img/email.png" alt="icone de email" />
                    </label>
                    <input id="field-email" value="<?php echo $_POST['field-email'] ?>" type="text" name="field-email" placeholder="  Email" />
                </div>

                <label for="field-message">
                    <img src="img/escrita.png" alt="icone de escrita" />
                </label>

                <textarea id="field-message" value="<?php echo $_POST['field-message'] ?>" class="field-message" name="field-message" placeholder=" Mensagem" cols="39" rows="5"></textarea>
                <div>
                    <button name="botton-submit" id="botton-submit" class="botton-submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>