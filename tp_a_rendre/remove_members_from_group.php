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
        <link rel="stylesheet" href="remove_member.css">
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>
        <?php include "ban.php"; ?>
        <h1>Membre actuel du groupe:</h1>
        <form method="POST" class="groupe">
            <?php
            $membres = selectMembresGroupe($idGroupe);
            foreach ($membres as $m) {
                $nom = $m["nom"];
                $email = $m["adresse_mail"];
                $prenom = $m["prenom"];
                echo "<input type='checkbox' name='membreToDelete[]' value='$email'>$email <br>";
            }

            ?>
            <input type="submit" name="submit" value="Supprimer">
        </form>
    </body>

    </html>

<?php

}
if (isset($_POST["submit"])) {
    foreach ($_POST["membreToDelete"] as $email) {
        deleteFromGroupeMembreWhereEmail($email, $idGroupe);

        header("Location: show_all_discussions.php");
    }
}

?>