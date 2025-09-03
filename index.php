<?php

require_once("./db.php");

// echo "<pre>",var_dump($users),"</pre>"
// echo $_GET["idRemove"];

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
                    <td><?= $user['nom']; ?></td>
                    <td><?= $user["prenom"]; ?></td>
                    <td><?= $user["mail"]; ?></td>
                    <td><?= $user["code_postal"]; ?></td>
                    <td><a href='./functions/remove.php?idUser=<?=$user['id']?>'>Supprimer</a></td>
                    <td><a href='./view/form.php?idUser=<?=$user['id']?>'>Modifier</a></td>
                </tr>
                <?php endforeach ?>
            </table>
        </section>

    </main>
</body>

</html>