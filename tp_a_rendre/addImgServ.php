<?php include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>

    <!DOCTYPE html>
    <html>

    <body>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Sélectionnez une image depuis votre appareil :</label></br>
            <input type="file" name="fileToUpload" accept="image/*"></br>
            <input type="submit" value="Envoyer"></br>
        </form>

        <?php


        $imageName = $_SESSION['email'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_FILES['fileToUpload']['size'] < 500000) {
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/profiles/$imageName");
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