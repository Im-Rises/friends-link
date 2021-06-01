<?php
include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL and mysqli_fetch_array(verifPostExiste($_GET['idPost']))['1'] == 1) {
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
        //var_dump($_GET);

        echo "<h2>Post</h2>";

        $post = selectPostsFromId($_GET['idPost']);
        $post = mysqli_fetch_array($post);
        if ($post['image_post'] == 1) {
            echo "<div>";
            echo "<p>$post[email_posteur]</p>";
            echo "<p>$post[titre]</p>";
            echo "<p>$post[post_text]</p>";
            echo "<p>$post[datePost]</p>";
            echo "<img src='images/posts/$post[id_post]' width='200' height='200'>";
            echo "</div>";
        } else {
            echo "<div>";
            echo "<p>$post[email_posteur]</p>";
            echo "<p>$post[titre]</p>";
            echo "<p>$post[post_text]</p>";
            echo "<p>$post[datePost]</p>";
            echo "</div>";
        }


        $listeMessages = selectMessagesFromPost($_GET['idPost']);

        echo "<h2>Commentaires</h2>";

        foreach ($listeMessages as $message) {
            //var_dump($message);
            echo "<div>";
            echo "<p>$message[adresse_mail]</p>";
            echo "<p>$message[nom]</p>";
            echo "<p>$message[prenom]</p>";
            echo "<p>$message[datePost]</p>";
            echo "<p>$message[message_post_text]</p>";
            echo "</div>";
        }

        ?>


        <form action="" method="post">
            <label for="message">Votre réaction :</label></br>
            <textarea name="message" placeholder="Entrez votre message ici !"></textarea></br>
            <input type="submit" name="poster">
        </form>


        <?php
        //var_dump($_FILES);
        if (isset($_POST["message"], $_GET['idPost']) and $_POST["message"] != NULL and $_GET['idPost'] != NULL) {
            insertIntoPost_Message($_GET['idPost'], $_SESSION['email'], $_POST["message"]);
            header("Refresh:0");
        }
        ?>

    </body>

    </html>

<?php
} else {
    header('Location: index.php');
}
?>