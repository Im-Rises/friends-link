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

    function insertIntoLivre($titre, $auteur)
    {
        global $connexion;

        $titre = htmlspecialchars($_POST["titre"]);
        $auteur = htmlspecialchars($_POST["auteur"]);
        $req = "SELECT * FROM auteur;";
        $array = mysqli_query($connexion, $req);

        $isAuthorExist = false;
        $idAuteur = 0;

        foreach ($array as $value) {
            if ($value["nom"] == $auteur) {
                $isAuthorExist = true;
                $idAuteur = $value["idAuteur"];
                break;
            }
        }
        if (!$isAuthorExist) {
            $req = "INSERT INTO auteur(nom) VALUES ('$auteur');";
            $res = mysqli_query($connexion, $req);
            if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";

            $req = "SELECT * FROM auteur WHERE nom='$auteur'";
            $res = mysqli_query($connexion, $req);
            if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
            foreach ($res as $value)
                $idAuteur = $value['idAuteur'];
        }

        $req = "INSERT INTO livre(titre, idAuteur) VALUES ('$titre', '$idAuteur');";

        $res = mysqli_query($connexion, $req);
        if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
        return $res;
    }

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