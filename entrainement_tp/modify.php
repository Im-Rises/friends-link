<?php

require "dao.php";

if (isset($_GET['id'])) {
    $array = selectFromLivreWhereId($_GET['id']);
    foreach ($array as $lv) {
        $titre = $lv['titre'];
        $auteur = $lv['auteur'];
        $date_creation = $lv['date_creation'];

        echo "
            <form action='' method='POST'>
                <input type='text' value='$titre' name='titre'>
                <input type='text' value='$auteur' name='auteur'>
                <input type='date' value='$date_creation' name='date_creation'>
                <input type='submit'>
            </form>";
    }
}

if(isset($_POST["titre"], $_POST["auteur"], $_POST["date_creation"])) {

    updateFromLivreWhereId($_GET['id'], $_POST["titre"], $_POST["auteur"], $_POST["date_creation"]);
    header('Location: ajout_livre.php');


}
?>