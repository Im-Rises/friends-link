<?php
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "gestion_livre";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Page de suppression livre</title>
</head>

<body>

    <?php

    $req = "SELECT * FROM livre";
    $connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);
    if ($connexion) {
        $res = mysqli_query($connexion, $req);

        if ($req) {
            echo "<h1>Suppression d'un livre</h1>";

            echo
            "<form action='' method='POST'>
                <fieldset>
                    <label for='livre'>Identifiant du livre</label>
                    <select id=livre_suppression>";

            foreach ($res as $ligne) {
                echo "<option value=''>Text</option>";
            }

            echo
                    "</select>
                    <input type='submit'><br/>
                    <a href='index.php'>Retour<a>
                </fieldset>
            </form>";
        } else {
            echo "<p>Reqête non valable base de données";
        }

        if (isset($_POST)) {

            $req = "DELETE FROM livre WHERE id=$_POST[id]";
            echo $req;
            $res = mysqli_query($connexion, $req);

            if ($res) {
                echo "<p>Suppression réussie</p>";
            } else {
                echo "<p>Suppression non réussie</p>";
            }
        }
    } else {
        echo "<p>Non connecté à la base de données";
    }
    ?>


</body>

</html>