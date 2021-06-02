<?php
session_start();
include "dao.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Mes discussions</title>
        <link rel="stylesheet" href="show_all_discussions.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>


    <body>
        <?php
        include "ban.php";
        include "search_friends.php";
        ?>

        <div class="allTab">
            <h1>Tous les amis :</h1>

            <?php
            $array = selectAllFriendsWhereEmail($_SESSION["email"]);
            foreach ($array as $value) {
                $nom = $value["nom"];
                $prenom = $value["prenom"];
                $receiver = $value["adresse_mail"];

                echo "
                    <div class='divBody'>
                        <a href='messages.php?receiver=$receiver'><div class='pdpBodyElement'><img src='" . recupImageEmail($receiver) . "' class='pdp' alt='image de profil'></div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$nom</div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$prenom</div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$receiver</div></a>
                    </div>";
            }
            ?>
            
        </div>

        <div class="allTab">
            <h1>Tous les groupes :</h1>
            <?php
            $array = selectAllGroupes($_SESSION["email"]);
            foreach ($array as $value) {
                $nom = $value["nom"];
                $id = $value["id"];
                echo "
                    <br>
                    <div class='divBody'>
                        <a href='message_groupe.php?id=$id'><div class='bodyElement'><img src='" . recupImageGroupe($id) . "' class='pdp'></div></a>
                        <a href='message_groupe.php?id=$id'><div class='bodyElement'>$nom</div></a>
                    </div>";
            }
            ?>
        </div>
        <a href="new_group.php" class="groupe">Cliquer-ici pour créer un nouveau groupe</a>
    </body>

    </html>
<?php
} else {
    echo "<center>vous devez vous connecter !</center>";
    echo "vous allez être redirigés";
    header("Location: login.php");
} ?>