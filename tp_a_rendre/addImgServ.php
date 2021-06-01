<?php include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Modification image</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Sélectionnez une image depuis votre appareil :</label></br>
            <input type="file" name="fileToUpload" accept="image/*"></br>
            <input type="submit" value="Envoyer"></br>
        </form>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $imageActuelle = "images/profiles/".selectNomImageFromEmail($_SESSION['email'])['nomImage'];

            if ( $imageActuelle != NULL && file_exists($imageActuelle)) {
                unlink($imageActuelle);
            }

            $imageName = $_SESSION['email'].date("Y-m-d").time();   

            if ($_FILES['fileToUpload']['size'] < 500000) {
                updateImageMembre($_SESSION['email'], $imageName);
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/profiles/$imageName");
                header("Location: addImgServ.php");
            } else {
                echo "<p>Fichier trop lourd, veuillez sélectionner une image de moins de 500ko</p>";
            }
        }
        ?>

        <a href="mon_profil.php">Retour sur mon profil</a>
    </body>

    </html>

<?php
} else {
    header("Location: login.php");
}
?>