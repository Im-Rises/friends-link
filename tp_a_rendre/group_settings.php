<?php
include "ban.php";

$idGroupe = $_SESSION["idGroupe"];

$email = $_SESSION["email"];

$admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);

if (!isAdmin($admins, $email)) {
    header("Location: index.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Group Settings</title>
    </head>

    <body>
        <ul>
            <li>
                <a href="addMembersToGroup.php">ajouter des membres</a>
            </li>
            <li>
                <a href="modifyGroupName.php">modifier le nom du groupe</a>
            </li>
            <li>
                <a href="addAdministratorsToGroup.php">ajouter des administrateurs au groupe</a>
            </li>
        </ul>
    </body>

    </html>

<?php

}

?>