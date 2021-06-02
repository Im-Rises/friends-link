<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modifyGroup.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <?php
    $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>
    <title>Modifier le nom du groupe</title>
</head>

<?php
session_start();
require "dao.php";
include "ban.php";

$idGroupe = $_SESSION["idGroupe"];

$email = $_SESSION["email"];

$admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);

if (!isAdmin($admins, $email)) {
    header("Location: index.php");
} else { ?>

    <body>

        <form action="" method="POST">
            <div class="modif">
                <legend>Nouveau nom du groupe:</legend>
                <input type="text" name="nom">
                <input type="submit">
            </div>
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