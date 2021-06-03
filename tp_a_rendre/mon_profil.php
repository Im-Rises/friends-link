<?php
session_start();
include "dao.php";
//Si utilisateur est connecté, affichage de la page
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <title>Profil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="mon_profil.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>


    <body>

        <?php
        include "ban.php";

        if (isset($_GET['email']) and $_GET['email'] != NULL) {

            $emailTest = mysqli_fetch_array(verifEmailExiste($_GET['email']))[1];

            if ($emailTest == 1) {



                $profil = mysqli_fetch_array(selectMembreWhereEmail($_GET['email']));

                //affichage des infos de l'utilisateur connecté 
                echo "<h1>$profil[prenom] $profil[nom]</h1>";
                echo "<p class='centerText'>Adresse mail : ";
                echo $profil['adresse_mail'];
                echo "</p>";

                if ($_SESSION["email"] == $profil['adresse_mail']) {
                    echo "<a href=addImgServ.php><img src='" . recupImageEmail($profil['adresse_mail']) . "' class='pdpMonProfile' alt='image de profil'></a>";
                    echo "<p>Vous pouvez modifier votre image de profil en cliquant sur l'image de profil</p>";
                } else {
                    echo "<a href='messages.php?receiver=$_GET[email]'><img src='" . recupImageEmail($profil['adresse_mail']) . "' class='pdpMonProfile' alt='image de profil'></a>";
                    echo "<p>Envoyez un message personnel à cette personne en cliquand sur son image de profil</p>";
                }




                echo "<h2>Liste d'amis</h2>";

                if (isset($_GET['voirPlusAmis']) and $_GET['voirPlusAmis'] != NULL) {
                    $array = selectAllFriendsWhereEmail($_GET['email']);
                    foreach ($array as $value) {
                        $nom = $value["nom"];
                        $prenom = $value["prenom"];
                        $receiver = $value["adresse_mail"];

                        echo "
                    <br>
                    <div class='divBody'>
                        <a href='?email=$receiver'><div class='pdpBodyElement'><img src='" . recupImageEmail($receiver) . "' class='pdp' alt='image de profil'></div></a>
                        <a href='?email=$receiver'><div class='bodyElement'>$nom</div></a>
                        <a href='?email=$receiver'><div class='bodyElement'>$prenom</div></a>
                        <a href='?email=$receiver'><div class='bodyElement'>$receiver</div></a>
                        <a href='?suppression=$receiver'><div class='bodyElement'>Suppression</div></a>
                    </div>";
                    }
                    echo "<a href='?email=$_GET[email]' class='centerText'>Réduire amis</a>";
                } else {
                    echo "<a href='?email=$_GET[email]&voirPlusAmis=voirplus' class='centerText'>Voir amis</a>";
                }





                echo "<h2>Liste des posts</h2>";

                if (isset($_GET['voirPlusPosts']) and $_GET['voirPlusPosts'] != NULL) {
                    $listePosts = selectAllPostsFromMembreOrder($_GET['email']);

                    foreach ($listePosts as $post) {
                        $array = selectLikesWhereEmailAndId($_GET['email'], $post["id_post"]);
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
                                    <img src='images/posts/$post[id_post] alt='image de post'>
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

                    echo "<a href='?email=$_GET[email]' class='centerText'>Voir moins</a>";
                } else {
                    echo "<a href='?email=$_GET[email]&voirPlusPosts=Voir' class='centerText'>Voir posts</a>";
                }
            } else {
                header('Location:index.php');
            }
        }
        ?>


        <?php
        if (isset($_GET['suppression']) and $_GET['suppression'] != NULL) {
            deleteAmitie($_SESSION["email"], $_GET['suppression']);
        }
        ?>

    </body>

    </html>

<?php
} else {
    header('Location:login.php');
}
?>