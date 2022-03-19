<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

if ($requestMethod === 'POST') {

    //verificaçao da existencia das chaves, criando uma string vazia se nao existir
    $name = isset($_POST['field-name']) ? $_POST['field-name'] : '';
    $email = isset($_POST['field-email']) ? $_POST['field-email'] : '';
    $message = isset($_POST['field-message']) ? $_POST['field-message'] : '';

    $erro = "";
    $imprimir = '';

    if (!filter_var(trim($name)) && empty($erro)) {
        $erro = "name";
        $imprimir = "preencha um nome valido ";
    }

    if ((!isset($email) || !filter_var(trim($email), FILTER_VALIDATE_EMAIL)) &&  empty($erro)) {
        $erro = "email";
        $imprimir = "preencha um email valido ";
    }

    if (!filter_var(trim($message)) && empty($erro)) {
        $erro = "message";
        $imprimir = "preencha uma mensagem valida";
    }

    if ($erro == "") {
        $from = $email;
        $to = "dy@dyvaz.com";
        $subject = "testando email php no mailhog";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = "localhost";
        $mail->Port       = 1025;
        $mail->SMTPAuth = true;
        $mail->setFrom($from, $name);
        $mail->addAddress($to);
        $mail->Subject = 'Testando Mailhog -php';
        $mail->Body = $message;

        $mail->Send();

        header('Location: /');
        exit();
    }
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

            <div class="caixa-erro">
                <?php if (isset($imprimir) && $imprimir !== '') { ?>
                    <img src="/img/error.png" alt="icone de error" id="icone-error">
                    <div class="error-message"><?php echo $imprimir; ?></div>
                <?php } else { ?>
                    <img src="/img/sucesso.png" alt="icone de sucesso" id="icone-sucesso">
                    <div class="sucesso-message"><?php echo 'E-mail enviado com sucesso!'; ?></div>
                <?php } ?>
            </div>

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