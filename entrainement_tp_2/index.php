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
    <title>Gestion bibliothèque</title>
</head>

<body>

    <?php

    $req = "SELECT * FROM livre";
    $connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);
    if ($connexion)
    {
        mysqli_query($connexion,$req);
        if ($req)
        {
            echo "<form action='' method='POST'>";
            
            foreach ($res as $ligne) {
                echo "<option value=''>Text</option>";
            }
            echo "";
            echo "</form>";
        }
        else
        {
            echo "<p>Reqête non valable base de données"; 
        }
    }
    else
    {
        echo "<p>Non connecté à la base de données";
    }
    ?>


</body>

</html>