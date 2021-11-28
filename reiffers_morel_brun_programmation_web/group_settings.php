<?php
session_start();
require "dao.php";

$idGroupe = $_SESSION["idGroupe"];

$email = $_SESSION["email"];

$admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);

if (!isAdmin($admins, $email)) {
    header("Location: index.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Group Settings</title>
        <link rel="icon" href="friends_link.svg" />
        <link rel="stylesheet" href="groupe_settings.css">
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>

    <body>
    <?php include "ban.php";?>
        <div class="wow">
            <ul>
                <li>
                    <a href="addMembersToGroup.php">Ajouter des membres</a>
                </li>
                <li>
                    <a href="modifyGroupName.php">Modifier le nom du groupe</a>
                </li>
                <li>
                    <a href="addAdministratorsToGroup.php">Ajouter des administrateurs au groupe</a>
                </li>
                <li>
                    <a href="remove_members_from_group.php">Supprimer des membres du groupe</a>
                </li>
                <li>
                    <a href="addImgGroupeServ.php">Changer image du groupe</a>
                </li>
            </ul>
        </div>
    </body>

    </html>

<?php

}

?>