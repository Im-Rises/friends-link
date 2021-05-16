<?php
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "gestion_livre";
$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);


/*
fonctions necessaires en php :

clement :
-   recuprer liste amis 

*/
// recuperer donnees membres depuis email
function selectDataMembersWhereEmail($email)
{
    global $connexion;

    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql

    $req = "SELECT * FROM membre WHERE adresse_mail = '$email';";
    return mysqli_query($connexion, $req);
}

// selectionner une discussion entre 2 emails
function selectDiscussionsWithTwoEmail($email1, $email2)
{
    global $connexion;

    $email1 = htmlspecialchars($email1); // protege des injections de code html ou js
    $email1 = htmlentities($email1); // protege des injections sql

    $email2 = htmlspecialchars($email2); // protege des injections de code html ou js
    $email2 = htmlentities($email2); // protege des injections sql

    $req = "SELECT  *
            FROM message_discussion
            WHERE email_envoyeur='$email1' 
            AND email_receveur='$email2' UNION 
            SELECT  *
            FROM message_discussion
            WHERE email_envoyeur='$email2' 
            AND email_receveur='$email1';";

    return mysqli_query($connexion, $req);
}

// selectionner tous les amis d'un email
function selectAllFriendsWhereEmail($email)
{
    global $connexion;

    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql

    $req = "SELECT * FROM ami WHERE amitiee=true AND email='$email';";

    return mysqli_query($connexion, $req);
}


/*

quentin :
-   recuperer toutes les discussions par email 
-   recuperer tous les groupes par email 
-   insertion des donnees
-   recuperer les messages appartenant a un groupe
*/
<<<<<<< HEAD

function selectGroupeMembre($id_groupe)
{
    $req="SELECT mail_membre FROM groupeMembre WHERE id_groupe=$id_groupe";

}

function selectMessageDiscussion($email1, $email2)
{
    $req="SELECT * FROM message_discussion WHERE email_envoyeur=$email1 AND email_receveur=$email2 UNION SELECT * FROM message_discussion WHERE email_envoyeur=$email2 AND email_receveur=$email1"; 
    
}

?>
=======
>>>>>>> 019111c6047de06a16b51e4d7931048e72f9e4bb
