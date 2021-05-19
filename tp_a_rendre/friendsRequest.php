<?php include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <title>FriendsLink</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <h1>Liste des demandes d'amis reçues :</h1>
        <div class='showTab'>
            <div class='divHead'>
                <div class='headElement'>Nom</div>
                <div class='headElement'>Prenom</div>
                <div class='headElement'>Email</div>
            </div>
            <?php
            $res = selectProfilsReceptionDemandeAmi($_SESSION["email"]);
            foreach ($res as $emails) {
                echo "
            <br>
            <div class='divBody'>
                <div class='bodyElement'>$emails[prenom]</div>
                <div class='bodyElement'>$emails[nom]</div>
                <div class='bodyElement'>$emails[adresse_mail]</div>
            </div>";
            }
            ?>
        </div>


        </br>


        <h1>Liste des demandes d'amis envoyées :</h1>
        <div class='showTab'>
            <div class='divHead'>
                <div class='headElement'>Nom</div>
                <div class='headElement'>Prenom</div>
                <div class='headElement'>Email</div>
            </div>
            <?php
            $res = selectProfilsDemandesEnAmi($_SESSION["email"]);
            foreach ($res as $emails) {
                echo "
            <br>
            <div class='divBody'>
                <div class='bodyElement'>$emails[prenom]</div>
                <div class='bodyElement'>$emails[nom]</div>
                <div class='bodyElement'>$emails[adresse_mail]</div>
            </div>";
            }
            ?>
        </div>

    </body>

    </html>
    
<?php } else {
    header("Location: login.php");
}
?>