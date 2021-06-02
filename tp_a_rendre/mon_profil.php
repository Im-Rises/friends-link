<?php
include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
    $profil = selectMembreWhereEmail($_SESSION["email"]);
    $profil = mysqli_fetch_array($profil);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Mon profil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="mon_profil.css">
    </head>

    <body>

        <?php

        echo "<h1>$profil[prenom] $profil[nom]</h1>";
        echo "<a href=addImgServ.php><img src='" . recupImageEmail($profil['adresse_mail']) . "'class='pdpMonProfile' ></a>";
        ?>

        <p class='centerText'>Adresse mail : <?php echo $profil['adresse_mail'] ?></p>

        <h2>Liste d'amis</h2>

        <?php
        if (isset($_GET['voirPlusAmis']) and $_GET['voirPlusAmis'] != NULL && $_GET['voirPlusAmis'] == 'Voir') {
        ?>

            <div class="allTab">
                <h1>tous les amis :</h1>
                <div class='showTab'>
                    <div class='divHead'>
                        <div class='headElement'>Image</div>
                        <div class='headElement'>Nom</div>
                        <div class='headElement'>Prenom</div>
                        <div class='headElement'>Email</div>
                    </div>


                    <?php
                    $listeAmi = selectAllFriendsWhereEmail($profil['adresse_mail']);
                    //$array = selectAllFriendsWhereEmail($_SESSION["email"]);

                    foreach ($listeAmi as $value) {
                        $nom = $value["nom"];
                        $prenom = $value["prenom"];
                        $receiver = $value["adresse_mail"];

                        echo "
                    <br>
                    <div class='divBody'>
                        <a href=''><div class='bodyElement'><img src=''" . recupImageEmail($receiver) . "' class='pdp'></div></a>
                        <a href=''><div class='bodyElement'>$nom</div></a>
                        <a href=''><div class='bodyElement'>$prenom</div></a>
                        <a href=''><div class='bodyElement'>$receiver</div></a>
                    </div>";
                    }

                    ?>
                </div>

                <a href='?voirPlusAmis=VoirMoins' class='centerText'>Voir moins</a>


            <?php
        } else {
            echo "<a href='?voirPlusAmis=Voir&voirPlusPost' class='centerText'>Voir amis</a>";
        }
            ?>




            <h2>Liste des posts</h2>

            <!-- Ici faire l'affichage de tous les posts de la personne -->

            <?php
            if (isset($_GET['voirPlusPosts']) and $_GET['voirPlusPosts'] != NULL && $_GET['voirPlusPosts'] == 'Voir') {

                $listePosts = selectAllPostsFromMembreOrder($profil['adresse_mail']);

                foreach ($listePosts as $post) {
                    if ($post['image_post'] == 1) {
                        echo "<div>";
                        echo "<p>$post[titre]</p>";
                        echo "<p>$post[post_text]</p>";
                        echo "<p>$post[datePost]</p>";
                        echo "<img src='images/posts/$post[id_post]' width='50' height='50'>";
                        echo "</div>";
                    } else {

                        echo "<div>";
                        echo "<p>$post[titre]</p>";
                        echo "<p>$post[post_text]</p>";
                        echo "<p>$post[datePost]</p>";
                        echo "</div>";
                    }
                }
            ?>
                <a href='?voirPlusPosts=VoirMoins' class='centerText'>Voir moins</a>
            <?php
            } else {
                echo "<a href='?voirPlusPosts=Voir' class='centerText'>Voir posts</a>";
            }
            ?>

    </body>

    </html>



<?php
} else {
    header("Location: login.php");
}
?>