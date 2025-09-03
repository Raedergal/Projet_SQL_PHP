<?php

require_once("../db.php");

if (isset($_GET["idUser"])) {
    echo $_GET["idUser"];
    $idUser = $_GET["idUser"];

    $codeSql = $db -> prepare("DELETE FROM users WHERE id = :idUser");
    $codeSql -> bindParam(":idUser", $idUser, PDO::PARAM_INT);

    $codeSql -> execute();


};

header("Location: ../index.php");


