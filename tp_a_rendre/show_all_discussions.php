<?php
include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="show_all_discussions.css">
    </head>

    <body>
        <?php include "search_friends.php"; ?>
        <div class="allTab">
            <h1>tous les amis :</h1>
                <?php
                $array = selectAllFriendsWhereEmail($_SESSION["email"]);
                foreach ($array as $value) {
                    $nom = $value["nom"];
                    $prenom = $value["prenom"];
                    $receiver = $value["adresse_mail"];

                    echo "
                    <div class='divBody'>
                        <a href='messages.php?receiver=$receiver'><div class='pdpBodyElement'><img src='" . recupImageEmail($receiver) . "' class='pdp'></div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$nom</div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$prenom</div></a>
                        <a href='messages.php?receiver=$receiver'><div class='bodyElement'>$receiver</div></a>
                    </div>";
                }

                ?>
            </div>
        </div>
        <div class="allTab">
            <h1>tous les groupes :</h1>
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
        <a href="new_group.php">New Group</a>
    </body>

    </html>
<?php
} else {
    echo "<center>vous devez vous connecter !</center>";
    echo "vous allez être redirigés";
    header("Location: login.php");
} ?>