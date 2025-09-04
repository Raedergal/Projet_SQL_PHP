<?php

session_start();

require_once("./db.php");
require_once("./functions/editUser.php");


if (isset($_GET["idUser"])) {
    $_SESSION["id"] = $_GET["idUser"];
    $codeSql = $db->prepare("SELECT * FROM users WHERE id = :idUser");
    $codeSql->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $codeSql->execute();
    $user = $codeSql->fetch(PDO::FETCH_ASSOC);
};


// echo "<pre>",var_dump($_GET["idUser"]),"</pre>";
// echo "<pre>",var_dump($_POST),"</pre>";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet PHP/SQL</title>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <main>
        <section>
            <h1>Utilisateurs</h1>
            <a class="button" href="./view/form.php">Créer</a>
            <table>
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Email</td>
                    <td>Code Postal</td>
                </tr>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <?php if (isset($_GET["idUser"]) && strval($user["id"]) === $_GET["idUser"]) : ?>
                            <form method="POST" action="">
                                <td>
                                    <input type="text" name="lastname" value='<?= $user["nom"] ?>'>
                                    <?php if (isset($error["lastname"])) echo "<p>" . $error["lastname"] . "</p>" ?>
                                </td>

                                <td>
                                    <input type="text" name="firstname" value='<?= $user["prenom"] ?>'>
                                    <?php if (isset($error["firstname"])) echo "<p>" . $error["firstname"] . "</p>" ?>
                                </td>

                                <td>
                                    <input type="text" name="email" value='<?= $user["mail"] ?>'>
                                    <?php if (isset($error["email"])) echo "<p>" . $error["email"] . "</p>" ?>
                                </td>

                                <td>
                                    <input type="text" name="postalCode" value='<?= $user["code_postal"] ?>'>
                                    <?php if (isset($error["postalCode"])) echo "<p>" . $error["postalCode"] . "</p>" ?>
                                </td>

                                <td>
                                    <a href='./functions/remove.php?idUser=<?= $user['id'] ?>'>Supprimer</a>
                                </td>
                                <td>
                                    <button id="validate" type="submit">Valider</button>
                                </td>
                            </form>
                        <?php else: ?>
                            <td><?= $user['nom']; ?></td>
                            <td><?= $user["prenom"]; ?></td>
                            <td><?= $user["mail"]; ?></td>
                            <td><?= $user["code_postal"]; ?></td>
                            <td><a href='./functions/remove.php?idUser=<?= $user['id'] ?>'>Supprimer</a></td>
                            <td><a href='?idUser=<?= $user['id'] ?>'>Modifier</a></td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </table>
        </section>

    </main>
</body>

</html>