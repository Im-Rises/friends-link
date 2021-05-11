<!DOCTYPE html>
<html>
<head>
    <title>ajouter livre</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require "dao.php";

    if (isset($_POST["titre"], $_POST["auteur"], $_POST["date"]) &&  $_POST["titre"] != NULL and $_POST["auteur"] != NULL and $_POST["date"] != NULL) {

        if (insertIntoLivre($_POST["titre"], $_POST["auteur"], $_POST["date"])) echo "ça a fonctionne avec la fonction !";
    } else {
        echo "titre, auteur, date non remplis correctement";
    }

    ?>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>titre</th>
                <th>auteur</th>
                <th>date</th>
                <th>operation</th>
            </tr>
        </thead>
        <tbody>

            <?php

            foreach (selectAllFromLivre() as $lv) {
                $id = $lv["id"];
                printf(
                    "
        <tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s %s</td>
        </tr>",
                    $id,
                    $lv["titre"],
                    $lv["auteur"],
                    $lv["date_creation"],
                    "<a href='modify.php?id=$id'>modifier</a>",
                    "<a href='delete.php?id=$id'>supprimer</a>"
                );
            }

            ?>

        </tbody>
    </table>
</body>



</html>