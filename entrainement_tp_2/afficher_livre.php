<?php require "dao.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Page d'affichage des livres d'un auteur</title>
</head>

<body>

    <?php

    if ($connexion) {
        $res = selectAllAuteur();

        if ($res) {
            echo "<h1>Selection d'un auteur</h1>";

            echo
            "<form method='POST' action=''>
                <fieldset>
                    <label>Identifiant de l'auteur</label>
                    <select name='select_auteur'>";

            foreach ($res as $ligne) {
                echo "<option value=$ligne[idAuteur]>$ligne[nom]</option>";
            }

            echo
            "</select>
                    <input type='submit' value='Afficher livres'><br/>
                    <a href='index.php'>Retour</a>
                </fieldset>
            </form>";
        } else {
            echo "<p>Base de données non accessible";
        }
    }

    // echo $_POST['select_auteur'];

    if (isset($_POST['select_auteur'])) {

        $res = selectLivresFromAuteur($_POST['select_auteur']);

        if ($res) {
            echo "<p>Liste des livres de l'auteur :</p>";

            echo "
            <table>
                <tr>
                    <th>Id</th>
                    <th>Titre</th>
                </tr>";
            foreach ($res as $livres) {
                echo "
                    <tr>   
                        <td>$livres[idLivre]</td>
                        <td>$livres[titre]</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Affichage impossible</p>";
        }
    }

    ?>

</body>

</html>