<?php
session_start();
require "dao.php";

//Si utilisateur est connecté, affichage de la page
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
    $profil = selectMembreWhereEmail($_SESSION["email"]);
    $profil = mysqli_fetch_array($profil);
    //echo $_SESSION["email"];
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="postCreation.css">
        <link rel="icon" href="friends_link.svg" />
        <title>Création d'un post</title>
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>



    <body>
        <?php
        include "ban.php";
        ?>
        <!-- Formulaire pour la création d'un post avec la possibilité d'y mettre une image -->
        <div class="newPost">
            <form action="postCreation.php" method="post" enctype="multipart/form-data">
                <input type="text" name="titre" placeholder="titre du post" class="titrePost"><br>
                <textarea name="message" placeholder="Entrez votre message ici !" class="message"></textarea><br>
                <input type="file" name="fileToUpload" accept="image/*" class="file"><br>
                <input type="submit" name="Poster" class="poster">
            </form>

        </div>

        <?php
        //Une fois le forms validé, le code ci-dessous va ajouter le post à la BDD et l'image sur le serveur pour son affichage
        if (isset($_POST["titre"], $_POST["message"]) and $_POST["titre"] != NULL and $_POST["message"] != NULL) {

            if ($_FILES['fileToUpload']['error'] == 0) {

                if ($_FILES['fileToUpload']['size'] < 1000000) {
                    insertIntoPost($_SESSION['email'], $_POST['titre'], $_POST['message'], 1);
                    $imageName = mysqli_fetch_array(selectLastPostIdMembre($_SESSION['email']));
                    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/posts/$imageName[id_post]");
                    header("Location: ./index.php");
                } else {
                    echo "<p>Fichier invalide ou trop lourd, veuillez sélectionner une image de moins de 500ko</p>";
                }
            } else {
                insertIntoPost($_SESSION['email'], $_POST['titre'], $_POST['message'], 0);
                header("Location: ./index.php");
            }
        }

        ?>

    </body>

    </html>

<?php
}
?>