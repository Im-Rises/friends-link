<?php require "dao.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>ajouter livre</title>
    <meta charset="utf-8">

</head>

<body>
    <fieldset>
        <legend>A REMPLIR </legend>
        <form action="" method="POST">
            <input type="text" placeholder="titre du livre" name="titre"> <br>
            <input type="text" placeholder="auteur" name="auteur"> <br>
            <input type="submit" value="Ajouter"> <br>
        </form>
    </fieldset>

    <?php

    if (isset($_POST["titre"], $_POST["auteur"]) &&  $_POST["titre"] != NULL and $_POST["auteur"] != NULL) {

        if (insertIntoLivre($_POST["titre"], $_POST["auteur"])) {
            echo "titre, auteur rempli correctement";
        } else {
            echo "probleme";
        }
    } else {
        echo "titre et auteur non remplis correctement";
    }
    ?>
</body>