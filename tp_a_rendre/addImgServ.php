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
        //var_dump($_FILES);

        //echo $_SESSION['email'];
        $imageName=$_SESSION['email'];
        //$imageName = "testToutout";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/$imageName");
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