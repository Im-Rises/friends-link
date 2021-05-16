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

*/

function selectDataMembersWhereEmail($email) {
    global $connexion;
    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql
    $req = "SELECT * FROM membre WHERE adresse_mail = '$email';";
    return mysqli_query($req, $connexion);
}


/*

quentin :
-   recuperer toutes les discussions par email 
-   recuperer tous les groupes par email 
-   insertion des donnees
-   recuperer les messages appartenant a un groupe
*/
?>