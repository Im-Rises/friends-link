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
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
        include "search_members_add_to_current_group.php";
        ?>
        <h1>Current Members of the group :</h1>
        <ul>
            <?php
            $membres = selectMembresGroupe($idGroupe);
            foreach ($membres as $m) {
                $nom = $m["nom"];
                $email = $m["adresse_mail"];
                $prenom = $m["prenom"];

                echo "<li> $nom $prenom, $email";
            }

            ?>
        </ul>

    </body>

    </html>

<?php

}

?>