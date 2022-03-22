<?php

use PHPMailer\PHPMailer\PHPMailer;


require 'vendor/autoload.php';

$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

if ($requestMethod === 'POST') {

    //verificaçao da existencia das chaves, criando uma string vazia se nao existir
    $name = isset($_POST['field-name']) ? $_POST['field-name'] : '';
    $email = isset($_POST['field-email']) ? $_POST['field-email'] : '';
    $message = isset($_POST['field-message']) ? $_POST['field-message'] : '';

    $erro = [];

    if (!filter_var(trim($name))) {
        array_push($erro, "name");
    }

    if ((!isset($email) || !filter_var(trim($email), FILTER_VALIDATE_EMAIL))) {
        array_push($erro, "email");
    }

    if (!filter_var(trim($message))) {
        array_push($erro, "message");
    }
    if (filter_var(trim($name) && filter_var(trim($email), FILTER_VALIDATE_EMAIL)) && filter_var(trim($message))) {
        echo $erro;
    }

    if (empty($erro)) {

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


        try {
            $mail->send();

            header('Location: /');
            exit();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
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
            <div>
                <div class="box-error">
                    <?php if (isset($erro) && !empty($erro)) { ?>
                        <?php for ($i = 0; $i < sizeof($erro); $i++) { ?>
                            <div class="error-message">
                                <img src="/img/error.png" alt="icone de error" id="icone-error">
                                <p>There was an error filling in the <?php echo "field $erro[$i]" ?>
                                </p>
                            </div>
                        <?php } ?>
                </div>
            <?php } else { ?>
                <div class="sucesso-message">
                    <img src="/img/sucesso.png" alt="icone de sucesso" id="icone-sucesso">
                    <p>Message sent successfully, thanks for contacting us</p>
                </div>
            <?php } ?>
            </div>
            <form action="/" method="post">
                <div>
                    <label for="field-name">
                        <img src="img/icon.png" alt="icone de perfil" />
                    </label>
                    <input id="field-name" value="<?php echo $_POST['field-name'] ?>" type="text" name="field-name" placeholder="  Name" <?php if (in_array("name", $erro)) { ?> class="alert" <?php } ?> />


                </div>
                <div>
                    <label for=" field-email">
                        <img src="img/email.png" alt="icone de email" />
                    </label>
                    <input id="field-email" value="<?php echo $_POST['field-email'] ?>" type="text" name="field-email" placeholder="  Email" <?php if (in_array("email", $erro)) { ?> class="alert" <?php } ?> />
                </div>

                <label for="field-message">
                    <img src="img/escrita.png" alt="icone de escrita" />
                </label>

                <textarea id="field-message" name="field-message" placeholder=" Mensagem" cols="39" rows="5" <?php if (in_array("message", $erro)) { ?> class="alert" <?php } ?>><?php echo $_POST["field-message"] ?></textarea>
                <div>
                    <button name="botton-submit" id="botton-submit" class="botton-submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>