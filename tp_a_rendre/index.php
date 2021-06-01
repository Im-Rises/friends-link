<!DOCTYPE html>
<html>

<?php include "ban.php"; ?>

<head>
    <title>Friends Link</title>
    <meta charset="utf-8" />
    <?php
    $css = isset($_SESSION["email"]) ? "indexLog.css" : "index.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>
</head>
<?php

echo $css;


if (!isset($_SESSION["email"])) {

?>

    <body>
        <div class="noLog">
            <img src="friends_link.svg" class="logo">

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

    </body>

<?php
} else {
?>

    <body>

        <?php
        $utilisateur = mysqli_fetch_array(selectMembreWhereEmail($_SESSION["email"]));
        echo "<p>Bonjour " . $utilisateur['prenom'] . " " . $utilisateur['nom'] . " !</p>";
        ?>

        <div>
            <?php include "postCreation.php"; ?>
        </div>

        <div class="listeDesPosts">
            <?php
            $listePosts = selectPostsFromAmis($_SESSION['email']);

            foreach ($listePosts as $post) {
                // Afficher la liste des posts des amis ici
                if ($post['image_post']) {
                    // echo "<a href='show_post.php?idPost=$post[id_post]'>";
                    // echo "<p>$post[email_posteur]</p>";
                    // echo "<form method='post'>
                    // <input type='submit' name='liker' value='Liker' />
                    // </form>";
                    echo "
                <div class='post'>
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
                            <a href='' class='actionPost'>Aimer</a>
                            <a href='' class='actionPost'>Commenter</a>
                        </div>
                    </div>

                </div>";
                    // echo "</a>";
                } else {

                    echo "
                <div class='post'>
                    <div class='insidePost'>
                        <h1>$post[titre]</h1>
                        <p>$post[datePost]</p>
                        <p>$post[post_text]</p>
                        <div class='actions'>
                            <a href='' class='actionPost'>Aimer</a>
                            <a href='' class='actionPost'>Commenter</a>
                        </div>
                    </div>
                </div>";
                    // echo "<div>";
                    // echo "<a href='show_post.php?idPost=$post[id_post]'>";
                    // echo "<p>$post[email_posteur]</p>";
                    // echo "<p>$post[titre]</p>";
                    // echo "<p>$post[post_text]</p>";
                    // echo "<p>$post[datePost]</p>";
                    // // echo "<form method='post'>
                    // // <input type='submit' name='liker' value='Liker' />
                    // // </form>";
                    // echo "</a>";
                    // echo "</div>";
                }
            }

            ?>
        </div>
    </body>

</html>

<?php
}
?>