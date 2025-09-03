<?php

require_once("../db.php");
require_once("../functions/createUser.php");
require_once("../functions/editUser.php");

if (isset($_GET["idUser"])) {
    $idUser = $_GET["idUser"];

    $codeSql = $db -> prepare("SELECT * FROM users WHERE id = :idUser");
    $codeSql -> bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $codeSql -> execute();
    $user = $codeSql -> fetch(PDO::FETCH_ASSOC);
};

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>

    <main>

        <section>
            
            <h1><?= $title = isset($_GET["idUser"]) ? "Modifie tes données" : "Rentre un nouveau utilisateur" ?></h1>
            <a class="button" href="../index.php">Retour</a>

            <form method="POST" action="">

                <label for="lastname">Nom</label>
                <input type="text" placeholder="Nom de famille" name="lastname" value='<?php if(isset($_GET["idUser"])) echo $user["nom"] ?>'>
                <?php if(isset($error["lastname"])) echo "<p>" . $error["lastname"] . "</p>" ?>

                <label for="firstname">Prénom</label>
                <input type="text" placeholder="Prénom" name="firstname" value='<?php if(isset($_GET["idUser"])) echo $user["prenom"] ?>'>
                <?php if(isset($error["firstname"])) echo "<p>" . $error["firstname"] . "</p>" ?>

                <label for="email">Email</label>
                <input type="text" placeholder="Adresse email" name="email" value='<?php if(isset($_GET["idUser"])) echo $user["mail"] ?>'>
                <?php if(isset($error["email"])) echo "<p>" . $error["email"] . "</p>" ?>

                <label for="postalCode">Code Postal</label>
                <input type="text" placeholder="Code postal de la ville" name="postalCode" value='<?php if(isset($_GET["idUser"])) echo $user["code_postal"] ?>'>
                <?php if(isset($error["postalCode"])) echo "<p>" . $error["postalCode"] . "</p>" ?>

                <button type="submit">Valider</button>

            </form>
        </section>

    </main>

</body>

</html>