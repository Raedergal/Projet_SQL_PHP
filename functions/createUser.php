<?php

require_once("../db.php");

$error = [];

if (isset($_POST["lastname"])) {
    if (!preg_match("/[A-z]+/", $_POST["lastname"])) {
        $error["lastname"] = "Rentre un nom de famille";
    }
    if (!preg_match("/[A-z]+/", $_POST["firstname"])) {
        $error["firstname"] = "Rentre un prénom";
    }
    if (!preg_match("/^[^@]+@[^@]+\.[^@]+$/", $_POST["email"])) {
        $error["email"] = "Rentre un email valide";
    }
    if (!preg_match("/[0-9]{5}+/", $_POST["postalCode"])) {
        $error["postalCode"] = "Rentre un code postal valide";
    }
}

if (isset($_POST["lastname"]) && !isset($_GET["idUser"])) {

    $codeSql = $db->prepare('SELECT mail FROM users');
    $codeSql->execute();
    $mails = $codeSql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($mails as $mail) {
        if ($mail["mail"] === $_POST["email"]) {
            $error["email"] = "Cet email existe déjà";
            break;
        }
    }

    if (
        !isset($error["lastname"]) &&
        !isset($error["firstname"]) &&
        !isset($error["email"]) &&
        !isset($error["postalCode"])
        ) {

        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $email = $_POST["email"];
        $postalCode = $_POST["postalCode"];

        $codeSql = $db->prepare(
            'INSERT INTO users(nom, prenom, mail, code_postal) 
                    VALUES (:nom, :prenom, :mail, :codePostal)'
        );

        $codeSql->bindParam(":nom", $lastname);
        $codeSql->bindParam(":prenom", $firstname);
        $codeSql->bindParam(":mail", $email);
        $codeSql->bindParam(":codePostal", $postalCode);

        $codeSql->execute();

        header("Location: ../index.php");
    }
}
