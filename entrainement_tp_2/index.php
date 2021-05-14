<?php require "dao.php"; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Gestion bibliothèque</title>
</head>

<body>
    <a href="ajouter.php">Ajouter un livre</a><br />
    <a href="suppression_livre.php">Supprimer un livre</a><br />
    <a href="afficher_livre.php">Afficher un livre</a><br />

    <form method='POST' action=''>
        <fieldset>
            <legend>Ajouter un auteur</legend>
            <label>Nom de l'auteur</label>
            <input type="text" name="nom"><br />
            <input type='submit' value='Ajouter'><br />
        </fieldset>
    </form>

    <?php

    echo $_POST['nom'];

    if (isset($_POST['nom'])) {

        $res = insertIntoAuteur($_POST['nom']);

        if ($res) {
            echo "<p>Ajout réussie</p>";
            header("Refresh:2");
        } else {
            echo "<p>Ajout non réussie</p>";
        }
    }

    ?>

</body>

</html>