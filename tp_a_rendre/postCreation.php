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

        <form action="" method="post" enctype="multipart/form-data">
            <label for="titre">Indiquez le titre de votre post :</label></br>
            <input type="text" name="titre"></br>
            <label for="message">Décrivez votre post :</label></br>
            <textarea name="message" placeholder="Entrez votre message ici !"></textarea></br>
            <label for="fileToUpload">Sélectionnez une image depuis votre appareil :</label></br>
            <input type="file" name="fileToUpload" accept="image/*"></br>
            <input type="submit" name="Poster">
        </form>


        <?php
        var_dump($_FILES);
        if (isset($_POST["titre"], $_POST["message"]) and $_POST["titre"] != NULL and $_POST["message"] != NULL) {
            //if (isset($_FILES['fileToUpload']) and $_FILES['fileToUpload'] != NULL) {
            if ($_FILES['fileToUpload']['error']==0) {

                if ($_FILES['fileToUpload']['size'] < 5000000) {
                    insertIntoPost($_SESSION['email'], $_POST['titre'], $_POST['message'], 1);
                    $imageName = mysqli_fetch_array(selectLastPostIdMembre($_SESSION['email']));
                    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/posts/$imageName[id_post]");
                } else {
                    echo "<p>Fichier trop lourd, veuillez sélectionner une image de moins de 500ko</p>";
                }
            } else {
                insertIntoPost($_SESSION['email'], $_POST['titre'], $_POST['message'], 0);
                echo "Passe pas où je veux";
            }
        }
        ?>

    </body>

    <html>

<?php
} else {
    //header("HTTP/1.0 404 Not Found");
}
