<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modifyGroup.css">
    <title>Modifier le nom du groupe</title>
</head>

<?php
include "ban.php";

$idGroupe = $_SESSION["idGroupe"];

$email = $_SESSION["email"];

$admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);

if (!isAdmin($admins, $email)) {
    header("Location: index.php");
} else { ?>

    <body>
        <form action="" method="POST">
            <input type="text" name="nom">
            <input type="submit">
        </form>
    </body>

</html>

<?php
    if (isset($_POST['nom'], $_SESSION["idGroupe"]) && $_POST['nom'] != NULL && $_SESSION["idGroupe"] != NULL) {
        updateNomGroupe($_POST["nom"], $_SESSION["idGroupe"]);

        header("Location: show_all_discussions.php");
    }
}
?>