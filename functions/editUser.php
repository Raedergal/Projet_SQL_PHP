<?php

$error = [];
if (isset($_SESSION["id"])) $idUser = $_SESSION["id"];


if (isset($_POST["lastname"])) {

    // Check error

    if (!preg_match("/[A-z]+/", $_POST["lastname"])) {
        $error["lastname"] = "Rentre un nom de famille";
    }
    if (!preg_match("/[A-z]+/", $_POST["firstname"])) {
        $error["firstname"] = "Rentre un prénom";
    }
    if (!preg_match("/^[^@]+@[^@]+\.[^@]+$/", $_POST["email"])) {
        $error["email"] = "Rentre un email valide";
    }
    if (!preg_match("/^[0-9]{5}$/", $_POST["postalCode"])) {
        $error["postalCode"] = "Rentre un code postal valide";
    }

    // Check mail en double

    $codeSql = $db->prepare('SELECT mail FROM users WHERE id != :idUser');
    $codeSql->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $codeSql->execute();
    $mails = $codeSql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($mails as $mail) {
        if ($mail["mail"] === $_POST["email"]) {
            $error["email"] = "Cet email existe déjà";
            break;
        }
    }

    //Update

    if (
        !isset($error["lastname"]) &&
        !isset($error["firstname"]) &&
        !isset($error["email"]) &&
        !isset($error["postalCode"])
    ) {

        $lastname = htmlspecialchars($_POST["lastname"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $email = htmlspecialchars($_POST["email"]);
        $postalCode = htmlspecialchars($_POST["postalCode"]);


        $codeSql = $db->prepare(
            'UPDATE users 
            SET nom = :nom, 
                prenom = :prenom , 
                mail = :mail, 
                code_postal = :codePostal 
            WHERE id = :idUser'
        );

        $codeSql->bindValue(":idUser", $idUser, PDO::PARAM_INT);
        $codeSql->bindValue(":nom", $lastname);
        $codeSql->bindValue(":prenom", $firstname);
        $codeSql->bindValue(":mail", $email);
        $codeSql->bindValue(":codePostal", $postalCode);

        $codeSql->execute();

        $_SESSION["id"] = null;
        header("Location: ./index.php");
    }
}