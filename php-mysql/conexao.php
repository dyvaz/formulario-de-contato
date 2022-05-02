<?php
function db_conection()
{
    try {
        $pdo = new PDO(
            "mysql:host=12.0.0.1;port=3306;dbname=contact_form;",
            "Fm7ZKtSoYaBbXeZT5wGYAnZU4Uz979",
            "WvPpZGiA8edUP7Qb77Q535JfZa36do"
        );
        return $pdo;
    } catch (PDOException $e) {
        return false;
    }
}
