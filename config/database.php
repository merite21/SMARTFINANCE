<?php

$host = "sql213.infinityfree.com";
$dbname = "if0_42354642_smartfinance";
$user = "if0_42354642";
$password = "W7jJcrED54tStC";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Erreur de connexion à la base de données : " . $e->getMessage());

}
