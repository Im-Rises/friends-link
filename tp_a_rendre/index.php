<!DOCTYPE html>
<html>

<head>
    <title>Friends Link</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
</head>
<?php

include "ban.php";

// a executer si bdd supprimee et que flemme de refaire les etapes du site pour creer un compte

// insertIntoMembre("clement.reiffers@esme.fr", "reiffers", "clement", "2000-11-15", "mdp");
// insertIntoMembre("quentin.morel@esme.fr", "morel", "quentin", "1998-02-02", "mdp");
// insertIntoMembre("dorine.brun@esme.fr", "brun", "dorine", "2000-05-05", "mdp");


// insertIntoAmiDemandeAmi("clement.reiffers@esme.fr", "quentin.morel@esme.fr");
// creerAmitie("clement.reiffers@esme.fr", "quentin.morel@esme.fr", 1);

// insertIntoGroupe("groupe1");
// insertIntoGroupeMembre(1, "clement.reiffers@esme.fr");
// insertIntoGroupeMembre(1, "quentin.morel@esme.fr");
// insertIntoGroupeMembre(1, "dorine.brun@esme.fr");

// insertIntoAmiDemandeAmi("quentin.morel@esme.fr", "clement.reiffers@esme.fr");
// insertIntoAmiDemandeAmi("dorine.brun@esme.fr", "quentin.morel@esme.fr");





if (!isset($_SESSION["email"])) {

?>

    <body>
        <h1>Bienvenue à vous sur Friends Link (Sudrihack)</h1>

        <p>Vous êtes dans l'obligation de vous inscrire si vous n'avez pas fait de compte au préalable</p>

        <a href='login.php'>Connexion</a>

        <a href='register.php'>Inscirption</a>

    </body>

<?php
} else {
?>

    <body>
        <h1>Afficher l'actualité de la personne connectée</h1>

        <p>Afficher ici ?</p>

        <img src='images/poubelle/mauvaise_blague.jpg' width='800' height='600'>

    </body>


<?php
}
?>

</html>