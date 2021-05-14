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
        $req= "SELECT * FROM auteur; ";
        $array=mysqli_connect($connexion, $req);
        
        $isAuthorExist= false; 
        foreach ($array as $value){
            if ($value ["nom"]== $auteur) {
                $isAuthorExist= true;
                break ; 
            }
        }

        $req = "INSERT INTO livre(titre, auteur) VALUES ('$titre', '$auteur');";

        return mysqli_query($connexion, $req);
    }

    if (isset($_POST["titre"], $_POST["auteur"]) &&  $_POST["titre"] != NULL and $_POST["auteur"] != NULL ) {

        if (insertIntoLivre($_POST["titre"], $_POST["auteur"])) echo "titre, auteur rempli correctement";
    } else {
        echo "titre et auteur non remplis correctement";
    }
    ?>
</body>

