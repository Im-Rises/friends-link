<?php
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
    $profil = selectMembreWhereEmail($_SESSION["email"]);
    $profil = mysqli_fetch_array($profil);
    //echo $_SESSION["email"];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <form method="post" action="">
            <label for="titre">Indiquez le titre de votre post :</label></br>
            <input type="text" name="titre"></br>
            <label for="message">Décrivez votre post :</label></br>
            <textarea name="message" placeholder="Entrez votre message ici !"></textarea></br>
            <label for="fileToUpload">Sélectionnez une image depuis votre appareil :</label></br>
            <input type="file" name="fileToUpload" accept="image/*"></br>
            <input type="submit" name="Poster">
        </form>



        <?php

        if (isset($_POST["titre"], $_POST["message"]) and $_POST["titre"] != NULL and $_POST["message"] != NULL) {
            if (isset($_POST['fileToUpload']) and $_POST['fileToUpload'] != NULL) {

                $imageName;
                //var_dump($_FILES);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    if ($_POST['fileToUpload'] != NULL) {
                        echo $imageName;
                        if ($_FILES['fileToUpload']['size'] < 500000) {
                            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/posts/$imageName");
                            insertIntoPost($_SESSION['email'],$_POST['titre'],$_POST['message'],1);
                        } else {
                            echo "<p>Fichier trop lourd, veuillez sélectionner une image de moins de 500ko</p>";
                        }
                    }
                }
            }
            else{
                insertIntoPost($_SESSION['email'],$_POST['titre'],$_POST['message'],0);
            }

            //insertion du post
        }




        ?>


    </body>

    <html>

<?php
} else {
    //header("HTTP/1.0 404 Not Found");
}
