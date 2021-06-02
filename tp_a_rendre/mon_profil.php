<?php
session_start();
include "dao.php";
//Si utilisateur est connecté, affichage de la page
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
    $profil = selectMembreWhereEmail($_SESSION["email"]);
    $profil = mysqli_fetch_array($profil);
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <title>Mon profil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="mon_profil.css">
        <link rel="stylesheet" href="indexLog.css">
        <link rel="stylesheet" href="show_all_discussions.css">
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>

    <body>


        <?php
        include "ban.php";
        //affichage des infos de l'utilisateur connecté 
        echo "<h1>$profil[prenom] $profil[nom]</h1>";
        echo "<a href=addImgServ.php><img src='" . recupImageEmail($profil['adresse_mail']) . "' class='pdpMonProfile' alt='image de profil'></a>";
        ?>

        <p class='centerText'>Adresse mail : <?php echo $profil['adresse_mail'] ?></p>

        <h2>Liste d'amis</h2>

        <?php
        if (isset($_GET['voirPlusAmis']) and $_GET['voirPlusAmis'] != NULL && $_GET['voirPlusAmis'] == 'Voir') {
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
                        <a href='?suppression=$receiver'><div class='bodyElement'>Suppression</div></a>
                    </div>";
                }

                ?>
                <!-- </div> -->
                <!-- </div> -->
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
                    $array = selectLikesWhereEmailAndId($_SESSION["email"], $post["id_post"]);
                    $array = mysqli_fetch_array($array);

                    $like = empty($array)
                        ? "<a href='liker.php?id_post=$post[id_post]' class='actionPost'>Aimer</a>"
                        : "<a href='disliker.php?id_post=$post[id_post]' class='actionPost'>Ne Plus Aimer</a>";
                    // Afficher la liste des posts des amis ici
                    if ($post['image_post']) {
                        echo "
                    <article class='post'>
                        <div class='insidePost'>
                            <h1>$post[titre]</h1>
                            <p>$post[datePost]</p>
                            <div class='rangement'>
                                <div class='gauche'>
                                    <p>$post[post_text]</p>
                                </div>
                                <div class='droite'>
                                    <img src='images/posts/$post[id_post]'>
                                </div>
                            </div>
                            <div class='actions'>
                                $like
                                <a href='show_post.php?idPost=$post[id_post]' class='actionPost'>Commenter</a>
                            </div>
                        </div>
    
                    </article>";
                        // echo "</a>";
                    } else {
                        echo "
                    <article class='post'>
                        <div class='insidePost'>
                            <h1>$post[titre]</h1>
                            <p>$post[datePost]</p>
                            <p>$post[post_text]</p>
                            <div class='actions'>
                                $like
                                <a href='show_post.php?idPost=$post[id_post]' class='actionPost'>Commenter</a>
                            </div>
                        </div>
                    </article>";
                    }
                }

            ?>
                <a href='?voirPlusPosts=VoirMoins' class='centerText'>Voir moins</a>
            <?php
            } else {
                echo "<a href='?voirPlusPosts=Voir' class='centerText'>Voir posts</a>";
            }

            if (isset($_GET['suppression']) and $_GET['suppression'] != NULL) {
                deleteAmitie($_SESSION["email"], $_GET['suppression']);
            }
            ?>

    </body>

    </html>



<?php
} else {
    //Si utilisateur non-connecté, redirection à la connexion
    header("Location: login.php");
}
?>