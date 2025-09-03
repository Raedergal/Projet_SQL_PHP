<?php

try {

    $servername = "localhost";
    $username = "root";
    $password = "";

    $db = new PDO("mysql:host=$servername;dbname=projetsql_php", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    echo $e->getCode();
}

$codeSql = $db->prepare("SELECT * FROM users");
$codeSql -> execute();

$users = $codeSql -> fetchAll(PDO::FETCH_ASSOC);