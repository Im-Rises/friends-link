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

        <h1>tous les amis :</h1>
        <?php
        $array = selectEmailsDiscussion($_SESSION["email"]);
        foreach ($array as $value) {
            $nom = $value["nom"];
            $prenom = $value["prenom"];
            $receiver = $value["adresse_mail"];

            echo "<a href='messages.php?receiver=$receiver'>$nom $prenom</a>";
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