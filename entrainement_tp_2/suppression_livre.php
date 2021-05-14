<?php require "dao.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Page de suppression livre</title>
</head>

<body>

    <?php

    if ($connexion) {
        
        $res = selectAllLivres(); 

        if ($res) {
            echo "<h1>Suppression d'un livre</h1>";

            echo
            "<form method='POST' action=''>
                <fieldset>
                    <label>Identifiant du livre</label>
                    <select name='select_id'>";

            foreach ($res as $ligne) {
                echo "<option value=$ligne[idLivre]>$ligne[idLivre]</option>";
            }

            echo
            "</select>
                    <input type='submit' value='Supprimer'><br/>
                    <a href='index.php'>Retour</a>
                </fieldset>
            </form>";
        } else {
            echo "<p>Base de données non accessible";
        }



        if (isset($_POST['select_id'])) {

            echo $_POST['select_id'];
            $res = deleteLivre($_POST['select_id']);

            if ($res) {
                echo "<p>Suppression réussie</p>";
                header("Refresh:2");
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