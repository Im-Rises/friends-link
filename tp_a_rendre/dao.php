<?php 
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "gestion_livre";
$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);


/*
fonctions necessaires en php :

clement :
-   recuperer donnes membres en fonction email
-   recuperer tous les messages en fonction des deux emails
-   recuprer liste amis 

quentin :
-   recuperer toutes les discussions par email 
-   recuperer tous les groupes par email 
-   insertion des donnees
-   recuperer les messages appartenant a un groupe
*/
?>