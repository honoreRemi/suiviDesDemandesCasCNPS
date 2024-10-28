<?php

//recuperer la connexion a labase de donnee
require 'databaseConnexion.php';

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("DROP TABLE demandeur");
$pdo->exec("DROP TABLE demande");
$pdo->exec("DROP TABLE decision");
$pdo->exec("DROP TABLE role");
$pdo->exec("DROP TABLE utilisateur");
$pdo->exec("DROP TABLE administrateur");
$pdo->exec("DROP TABLE updatePassword");
echo 'the file is deleted successfuly';
?>