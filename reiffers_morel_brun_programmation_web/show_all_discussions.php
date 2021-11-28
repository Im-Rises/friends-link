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
        <link rel="icon" href="friends_link.svg" />
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>


    <body>
        <?php
        include "ban.php";
        include "search_friends.php";
        echo "<div class='allTab'>
        <h1>tous les amis (cliquez sur le profil pour lui envoyer un message !)</h1>
    <table style='width:100%;text-align:center;'>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                        </tr>
                    </thead>";
        ?>

        <?php
        $array = selectAllFriendsWhereEmail($_SESSION["email"]);
        foreach ($array as $value) {
            $nom = $value["nom"];
            $prenom = $value["prenom"];
            $receiver = $value["adresse_mail"];
            echo "
                    <tr>
                        <td><a href='messages.php?receiver=$receiver'><img src='" . recupImageEmail($receiver) . "' class='pdp' alt='image de profil'></a></td>
                        <td><a href='messages.php?receiver=$receiver'>$nom</a></td>
                        <td><a href='messages.php?receiver=$receiver'>$prenom</a></td>
                        <td><a href='messages.php?receiver=$receiver'>$receiver</a></td>
                    </tr>";
        }
        ?>

        </table>
        </div>
        <?php
        echo "<div class='allTab'>
                    <h1>tous les groupes(cliquez sur le groupe pour envoyer un message !)</h1>
                <table style='width:100%;text-align:center;'>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Nom du groupe</th>
                                    </tr>
                                </thead>";
        $array = selectAllGroupes($_SESSION["email"]);
        foreach ($array as $value) {
            $nom = $value["nom"];
            $id = $value["id"];
            echo "
                    <tr>
                        <td><a href='message_groupe.php?id=$id'><img src='" . recupImageGroupe($id) . "' class='pdp' alt=\"image de $nom\"></a></td>
                        <td><a href='message_groupe.php?id=$id'>$nom</a></td>
                    </tr>";
        }
        ?>
        </table>
        </div>
        <a href="new_group.php" class="groupe">Cliquer-ici pour créer un nouveau groupe</a>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
} ?>