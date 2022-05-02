<?php

require 'vendor/autoload.php';
require_once 'conexao.php';

function insert($pdo, $name, $email, $message, $visualized)
{
    $stm = $pdo->prepare("INSERT INTO contact_form ( name, email, message, visualized) VALUES (?, ?, ?, ?)");
    $stm->execute([$name, $email, $message, $visualized]);
    return $pdo->lastInsertId();
};

$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
$success = isset($_GET['success']) ? ($_GET['success'] === '1') : false;

if ($requestMethod === 'POST') {
    //verificaçao da existencia das chaves, criando uma string vazia se nao existir
    $name = isset($_POST['field-name']) ? trim($_POST['field-name']) : '';
    $email = isset($_POST['field-email']) ? trim($_POST['field-email']) : '';
    $message = isset($_POST['field-message']) ? trim($_POST['field-message']) : '';
    $visualized = 0;
    $errors = [];

    // a validaçao de cada campo
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
        $pdo = db_conection();
        if ($pdo !== false && insert($pdo, $name, $email, $message, $visualized)) {
            header("Location: /?success=1");
            exit();
        } else {
            $errors[] = "Error establishing a database connection";
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
    <p>PHP MYSQL</p>
    <div class="form-geral">
        <div>
            <div>
                <div class="box-error">
                    <?php foreach ($errors as $value) { ?>
                        <div class="error-message">
                            <img src="/img/error.png" alt="icone de error" id="icone-error">
                            <p><?php echo $value; ?></p>
                        </div>
                    <?php } ?>
                    <?php if ($success) { ?>
                        <div class="sucesso-message">
                            <img src="/img/sucesso.png" alt="icone de sucesso" id="icone-sucesso">
                            <p>Message sent successfully, thanks for contacting us</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <form action="/" method="post">
                <div>
                    <label for="field-name">
                        <img src="img/icon.png" alt="icone de perfil" />
                    </label>
                    <input id="field-name" value="<?php if (!empty($name)) echo $_POST['field-name'] ?>" type="text" name="field-name" placeholder="  Name" <?php if (isset($errors['name'])) { ?> class="alert" <?php } ?> />


                </div>
                <div>
                    <label for=" field-email">
                        <img src="img/email.png" alt="icone de email" />
                    </label>
                    <input id="field-email" value="<?php if (!empty($email)) echo $_POST['field-email'] ?>" type="email" name="field-email" placeholder="  Email" <?php if (isset($errors['email'])) { ?> class="alert" <?php } ?> />
                </div>

                <label for="field-message">
                    <img src="img/escrita.png" alt="icone de escrita" />
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