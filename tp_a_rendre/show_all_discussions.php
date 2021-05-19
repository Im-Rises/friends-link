<?php
include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php include "search_friends.php"; ?>
        <br>
        <h1>tous les amis :</h1>
        <div class='showTab'>
            <div class='divHead'>
                <div class='headElement'>Nom</div>
                <div class='headElement'>Prenom</div>
                <div class='headElement'>Email</div>
            </div>
            <?php
            $array = selectAllFriendsWhereEmail($_SESSION["email"]);
            foreach ($array as $value) {
                $nom = $value["nom"];
                $prenom = $value["prenom"];
                $receiver = $value["adresse_mail"];

                echo "
                    <br>
                    <div class='divBody'>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$nom</div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$prenom</div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$receiver</div></a>";
            }

            ?>
    </body>

    </html>
<?php
} else {
    echo "<center>vous devez vous connecter !</center>";
    echo "vous allez être redirigés";
    header("Location: login.php");
} ?>