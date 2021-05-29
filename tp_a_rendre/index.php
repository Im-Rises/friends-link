<!DOCTYPE html>
<html>

<head>
    <title>Friends Link</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="index.css">
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
        <div class="noLog">
            <img src="friends_link.svg" class="logo">

            <div class="logOrRegister">
                <h1>Bienvenue sur Friends Link! </h1>
                <h2>Le site qui vous rapproche de vos amis</h2>
                <div class="div2Log">
                    <a href='login.php'>
                        <div class='divLog'>Connexion</div>
                    </a>
                    <a href='register.php'>
                        <div class='divLog'>Inscription</div>
                    </a>
                </div>

            </div>

        </div>

    </body>

<?php
} else {
?>

    <body>

        <?php
        $utilisateur = mysqli_fetch_array(selectMembreWhereEmail($_SESSION["email"]));
        
        echo "<p>Bien le bonjour ".$utilisateur['prenom']." ".$utilisateur['nom']." </p>";
        ?>

        <p>Quoi de neuf aujourd'hui ?</p>

        <?php

        require "postCreation.php";

        ?>
        <!-- <h1>Afficher l'actualité de la personne connectée</h1>

        <p>Afficher ici ?</p>

        <img src='images/poubelle/mauvaise_blague.jpg' width='800' height='600'> -->

    </body>


<?php
}
?>

</html>