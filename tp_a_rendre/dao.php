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

    $req = "SELECT * FROM ami WHERE email='$email' AND amitiee=true;";

    return mysqli_query($connexion, $req);
}


/*

quentin :
*/

// Selection des discussion

function selectEmailsDiscussion($email)
{
    $req='SELECT email_receveur FROM message_discussion WHERE email_envouyeur=$email UNION SELECT email_envoyeur FROM message_discussion WHERE email_receveur=$email';
}

function selectMessagesDiscussion($email1, $email2)
{
    $req='SELECT * FROM message_discussion WHERE email_envoyeur=$email1 AND email_receveur=$email2 UNION SELECT * FROM message_discussion WHERE email_envoyeur=$email2 AND email_receveur=$email1'; 
    
}


// Selection des groupes

function selectAllGroupes($email)
{
    $req='SELECT DISTINCT id_groupe  FROM message_groupe WHERE mail_membre=$email';
}

function selectMembresGroupe($id_groupe)
{
    $req='SELECT mail_membre FROM groupeMembre WHERE id_groupe=$id_groupe';
}

function selectMessagesGroupe($idGroup)
{
    $req='SELECT * FROM message_groupe WHERE id_groupe=$idGroup;';
}



// Recuperer les demandes d'ami reçues

function selectDemandesAmi($email)
{
    $req='SELECT email_ami FROM ami WHERE email=$email AND amitie_validee=false';
}






?>
