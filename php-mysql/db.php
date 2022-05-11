<?php
function db_conection()
{
    try {
        $pdo = new PDO(
            "mysql:host=127.0.0.1;port=3306;dbname=contact_form;",
            "Fm7ZKtSoYaBbXeZT5wGYAnZU4Uz979",
            "WvPpZGiA8edUP7Qb77Q535JfZa36do"
        );
        return $pdo;
    } catch (PDOException $e) {
        return false;
    }
}

function insert($pdo, $name, $email, $message, $visualized)
{
    $stm = $pdo->prepare("INSERT INTO contact_form ( name, email, message, visualized) VALUES (?, ?, ?, ?)");
    $stm->execute([$name, $email, $message, $visualized]);
    return $pdo->lastInsertId();
};
