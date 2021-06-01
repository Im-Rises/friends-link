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
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php
        var_dump($_GET);
        $post=selectPostsFromId($_GET['idPost']);
        $post=mysqli_fetch_array($post);    
        if ($post['image_post'] == 1) {
            echo "<div>";
            echo "<p>$post[email_posteur]</p>";
            echo "<p>$post[titre]</p>";
            echo "<p>$post[post_text]</p>";
            echo "<p>$post[datePost]</p>";
            echo "<img src='images/posts/$post[id_post]' width='50' height='50'>";
            echo "</div>";
        } else {
            echo "<div>";
            echo "<p>$post[email_posteur]</p>";
            echo "<p>$post[titre]</p>";
            echo "<p>$post[post_text]</p>";
            echo "<p>$post[datePost]</p>";
            echo "</div>";
        }
        ?>

    </body>

    </html>

<?php
}
?>