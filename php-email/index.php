<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

$success = isset($_GET['success']) ? ($_GET['success'] === '1') : false;

if ($requestMethod === 'POST') {
    //verificação da existência das chaves, criando uma string vazia se não existir
    $name = isset($_POST['field-name']) ? trim($_POST['field-name']) : '';
    $email = isset($_POST['field-email']) ? trim($_POST['field-email']) : '';
    $message = isset($_POST['field-message']) ? trim($_POST['field-message']) : '';

    $errors = [];

    if ($name === "") {
        // $errors[] é o mesmo que usar array_push($errors, '...') porém sem fazer uma chamada de função
        $errors['name'] = 'There was an error filling in the name';
    }

    if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'There was an error filling in the email';
    }

    if ($message === "") {
        $errors['message'] = 'There was an error filling in the message';
    }

    if (empty($errors)) {
        $from = $email;
        $to = "dy@dyvaz.com";


        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = "localhost";
        $mail->Port       = 1025;
        $mail->SMTPAuth = true;
        $mail->setFrom($from, $name);
        $mail->addAddress($to);
        $mail->Subject = 'Testing Mailhog -php';
        $mail->Body = $message;

        try {
            $mail->send();
            header("Location: /?success=1");
            exit();
        } catch (Exception $e) {
            $errors[] = 'We had a server error, please try again later';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Contact Form</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="icon" href="img/icon-page.png" />
</head>

<body>
    <div class="form-geral">
        <div>
            <div>
                <div class="box-error">
                    <?php foreach ($errors as $value) { ?>
                        <div class="error-message">
                            <img src="img/error.png" alt="error icon" id="error-icon">
                            <p><?php echo $value; ?></p>
                        </div>
                    <?php } ?>
                    <?php if ($success) { ?>
                        <div class="sucess-message">
                            <img src="/img/success.png" alt="success icon" id="success-icon">
                            <p>Message sent successfully, thanks for contacting us</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <form action="/" method="post">
                <div>
                    <label for="field-name">
                        <img src="img/icon.png" alt="profile icon" />
                    </label>
                    <input id="field-name" value="<?php if (!empty($name)) echo $_POST['field-name'] ?>" type="text" name="field-name" placeholder="  Name" <?php if (isset($errors['name'])) { ?> class="alert" <?php } ?> />


                </div>
                <div>
                    <label for=" field-email">
                        <img src="img/email.png" alt="email icon" />
                    </label>
                    <input id="field-email" value="<?php if (!empty($email)) echo $_POST['field-email'] ?>" type="email" name="field-email" placeholder="  Email" <?php if (isset($errors['email'])) { ?> class="alert" <?php } ?> />
                </div>

                <label for="field-message">
                    <img src="img/message.png" alt="message icon" />
                </label>

                <textarea id="field-message" name="field-message" placeholder=" Mensagem" cols="39" rows="5" <?php if (isset($errors['message'])) { ?> class="alert" <?php } ?>><?php if (!empty($message)) echo $_POST["field-message"] ?></textarea>
                <div>
                    <button name="botton-submit" id="botton-submit" class="botton-submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>