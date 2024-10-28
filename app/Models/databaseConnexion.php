<?php

$host = 'localhost';
$db = 'suividemandestage';
$user = 'root';
$password = '';
$port = '3306';
$charset  = 'utf8';

$dns = "mysql:host=$host;dbname=$db;port=$port;charset=$charset"; //no space
$options = [
    PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES    => false,
];

try {
    $pdo = new \PDO($dns, $user, $password, $options);
} catch (PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
