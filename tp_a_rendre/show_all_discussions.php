<?php
require "dao.php";
include "search_friends.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $array = selectEmailsDiscussion($_SESSION["email"]);
    foreach($array as $value) {
        $nom = $value["nom"];
        $prenom = $value["prenom"];
        $receiver = $value["adresse_mail"];

        echo "<a href='messages.php?receiver=$receiver'>$nom $prenom</a>";
    }
    ?>
</body>

</html>