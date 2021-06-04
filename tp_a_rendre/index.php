<?php
session_start();
include "dao.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Friends Link</title>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="60">
    <link rel="icon" href="friends_link.svg" />
    <?php
    // css de l'index
    $css = isset($_SESSION["email"]) ? "indexLog.css" : "index.css";
    echo "<link rel='stylesheet' href='$css'>";

    // css de la banniere
    $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>
</head>

<body>

    <?php
    include "ban.php";

    if (!isset($_SESSION["email"])) {

    ?>

        <div class="noLog">
            <img src="friends_link.svg" class="logo" alt='logo de friends_link'>

            <div class="logOrRegister">
                <h1>Bienvenue sur Friends Link! </h1>
                <h2>Le site qui vous rapproche de vos amis</h2>
                <div class="div2Log">
                    <a href='login.php'>
                        <div class='divLog'>Connexion</div>
                    </a>
                    <a href='register.php'>
                        <div class='divLog'>Inscription</div>
                    </a>
                </div>

            </div>

        </div>

    <?php
    } else {
    ?>

        <?php
        $utilisateur = mysqli_fetch_array(selectMembreWhereEmail($_SESSION["email"]));
        ?>


        <div class="listeDesPosts">
            <div class="divNewPost">
                <a href="postCreation.php" class="newPost">Nouveau Post</a>
            </div>

            <?php
            $listePosts = selectPostsFromAmis($_SESSION['email']);

            if (!mysqli_num_rows($listePosts)) {
            ?>
                <article class='post'>
                    <div class="insidePost">
                        <h1>vous n'avez aucuns posts dans votre fil d'actualité</h1>
                        faites des demandes d'amis, ou demandez à vos amis d'y mettre des posts !
                    </div>
                </article>
        <?php
            }
            foreach ($listePosts as $post) {

                $array = selectLikesWhereEmailAndId($_SESSION["email"], $post["id_post"]);
                $array = mysqli_fetch_array($array);

                $membre = selectMembreWhereEmail($post["email_posteur"]);
                $membre = mysqli_fetch_array($membre);

                $nbrLike = countLikesFromIdPost($post["id_post"]);
                $nbrLike = mysqli_fetch_array($nbrLike);
                $nbrLike = $nbrLike["COUNT(*)"];
                $nbrLike = "$nbrLike ❤";

                $peopleLikes = selectAllMembersWhoLikeIdPost($post["id_post"]);
                if ($peopleLikes != NULL) {
                    $a = "";
                    while ($value = mysqli_fetch_array($peopleLikes)) {
                        $prenom = $value["prenom"];
                        $nom = $value["nom"];
                        $a .= "$nom $prenom, ";
                    }
                    $peopleLikes = $a;
                } else {
                    $peopleLikes = "";
                }

                $page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);

                $like = empty($array)
                    ? "<a href='liker.php?id_post=$post[id_post]&page=$page' class='actionPost'>Aimer ❤</a>"
                    : "<a href='disliker.php?id_post=$post[id_post]&page=$page' class='actionPost'>Ne plus Aimer 💔</a>";

                // Afficher la liste des posts des amis ici
                if ($post['image_post']) {
                    echo "
                <article class='post'>
                    <div class='insidePost'>
                        <h1>$membre[nom] $membre[prenom] : $post[titre]</h1>
                        <p>$post[datePost]</p>
                        <div class='rangement'>
                            <div class='gauche'>
                                <p>$post[post_text]</p>
                            </div>
                            <div class='droite'>
                                <img src='images/posts/$post[id_post]' alt='image du post'>
                            </div>
                        </div>
                        <div class='actions'>
                            $like
                            <a href='show_post.php?idPost=$post[id_post]' class='actionPost'>Commenter 💬</a>
                            <abbr title='$peopleLikes'>$nbrLike</abbr>
                        </div>
                    </div>
                </article>";
                } else {
                    echo "
                <article class='post'>
                    <div class='insidePost'>
                        <h1>$membre[nom] $membre[prenom] : $post[titre]</h1>
                        <p>$post[datePost]</p>
                        <p>$post[post_text]</p>
                        <div class='actions'>
                            $like
                            <a href='show_post.php?idPost=$post[id_post]' class='actionPost'>Commenter 💬</a>
                            $nbrLike
                        </div>
                    </div>
                </article>";
                }
            }
        }
        ?>
        </div>

</body>


</html>