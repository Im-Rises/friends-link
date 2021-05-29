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
        <label for="fileToUpload" for="message">Décrivez votre post :</label></br>
        <textarea placeholder="Entrez votre message ici !" name="message"></textarea></br>
        <label for="fileToUpload">Sélectionnez une image depuis votre appareil :</label></br>
        <input type="file" name="fileToUpload" accept="image/*"></br>
        <input type="submit" name="Poster">
    </form>


    <?php


    $imageName = $_SESSION['email'];
    //var_dump($_FILES);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($_FILES['fileToUpload']['size'] < 500000) {
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "images/posts/$imageName");
        } else {
            echo "<p>Fichier trop lourd, veuillez sélectionner une image de moins de 500ko</p>";
        }
    }
    ?>


</body>

<html>