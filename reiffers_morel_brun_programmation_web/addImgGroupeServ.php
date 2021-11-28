<?php //Ajout de la bannière sur la page
session_start();
require "dao.php";
//Si utilisateur est connecté, affichage de la page
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
    $idGroupe = $_SESSION["idGroupe"];
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <title>Modification image</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="friends_link.svg" />
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>

    <body>
        <?php include "ban.php"; ?>

        <form method="post" enctype="multipart/form-data">
            <label for="imageServ">Sélectionnez une image depuis votre appareil :</label><br>
            <input type="file" name="fileToUpload" id="imageServ" accept="image/*"><br>
            <input type="submit" value="Envoyer"><br>
        </form>

        <?php
        /*Si le form ci-dessus est envoyé alors l'image envoyé en post va être ajouté à la BDD et au stockage du serveur 
         *Après vérification du fichier envoyé, s'il s'agit bien d'une image et si elle n'est pas trop lourde.
        */

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $imageActuelle = "images/groupes/" . selectNomImageFromGroupe($idGroupe)['nomImage'];

            $imageName = $idGroupe . date("Y-m-d") . time();

            if ($_FILES['fileToUpload']['error'] == 0) {

                if (mime_content_type($_FILES['fileToUpload']['tmp_name']) == 'image/png' || mime_content_type($_FILES['fileToUpload']['tmp_name']) == 'image/jpeg' || mime_content_type($_FILES['fileToUpload']['tmp_name']) == 'image/gif') {

                    if ($_FILES['fileToUpload']['size'] < 1000000) {
                        updateImageGroupe($idGroupe, $imageName);
                        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/groupes/$imageName");
                        if ($imageActuelle != NULL && file_exists($imageActuelle)) {
                            unlink($imageActuelle);
                        }

                        header("Location: addImgGroupeServ.php");
                    } else {
                        echo "<p>Fichier trop lourd, veuillez sélectionner une image de moins de 500ko</p>";
                    }
                } else {
                    echo "<p>Fichier invalide</p>";
                }
            } else {
                echo "<p>Aucunes images envoyées</p>";
            }
        }
        ?>

        <a href="group_settings.php">Retour sur les paramètres du groupe</a>
    </body>

    </html>

<?php
} else {
    header("Location: login.php"); //Retour à la page de connexion, si l'utilisateur n'est pas connecté
}
?>