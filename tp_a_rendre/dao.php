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

function selectGroupeMembre($id_groupe)
{
    $req="SELECT mail_membre FROM groupeMembre WHERE id_groupe=$id_groupe";

}

function selectMessageDiscussion($email1, $email2)
{
    $req="SELECT * FROM message_discussion WHERE email_envoyeur=$email1 AND email_receveur=$email2 UNION SELECT * FROM message_discussion WHERE email_envoyeur=$email2 AND email_receveur=$email1"; 
    
}

?>