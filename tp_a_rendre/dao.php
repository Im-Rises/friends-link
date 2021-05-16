<?php
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "gestion_livre";
$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);


// INSERT

function insertIntoMembre($email, $nom, $prenom, $bday)
{
    global $connexion;

    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql

    $nom = htmlspecialchars($nom); // protege des injections de code html ou js
    $nom = htmlentities($nom); // protege des injections sql

    $prenom = htmlspecialchars($prenom); // protege des injections de code html ou js
    $prenom = htmlentities($prenom); // protege des injections sql

    $bday = htmlspecialchars($bday); // protege des injections de code html ou js
    $bday = htmlentities($bday); // protege des injections sql

    $req = "INSERT INTO membre(adresse_mail, nom, prenom, date_naissance) VALUES ('$email', '$nom', '$prenom', '$bday');";
    return mysqli_query($connexion, $req);
}

// SELECT

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

// Selection des discussion
function selectEmailsDiscussion($email)
{
    global $connexion;

    $email = htmlspecialchars($email);
    $email = htmlentities($email);

    $req = "SELECT email_receveur FROM message_discussion WHERE email_envouyeur='$email' UNION SELECT email_envoyeur FROM message_discussion WHERE email_receveur='$email';";

    return mysqli_query($connexion, $req);
}

function selectMessagesDiscussion($email1, $email2)
{
    global $connexion;

    $email1 = htmlspecialchars($email1);
    $email1 = htmlentities($email1);

    $email2 = htmlspecialchars($email2);
    $email2 = htmlentities($email2);

    $req = "SELECT * FROM message_discussion WHERE email_envoyeur='$email1' AND email_receveur='$email2' UNION SELECT * FROM message_discussion WHERE email_envoyeur='$email2' AND email_receveur='$email1';";

    return mysqli_query($connexion, $req);
}


// Selection des groupes
function selectAllGroupes($email)
{
    global $connexion;

    $email = htmlspecialchars($email);
    $email = htmlentities($email);

    $req = "SELECT DISTINCT id_groupe  FROM message_groupe WHERE mail_membre='$email';";

    return mysqli_query($connexion, $req);
}

function selectMembresGroupe($id_groupe)
{
    global $connexion;

    $req = "SELECT mail_membre FROM groupeMembre WHERE id_groupe='$id_groupe';";

    return mysqli_query($connexion, $req);
}

function selectMessagesGroupe($idGroup)
{
    global $connexion;

    $req = "SELECT * FROM message_groupe WHERE id_groupe='$idGroup';";

    return mysqli_query($connexion, $req);
}

// Recuperer les demandes d'ami reçues
function selectDemandesAmi($email)
{
    global $connexion;

    $email = htmlspecialchars($email);
    $email = htmlentities($email);

    $req = "SELECT email_ami FROM ami WHERE email='$email' AND amitie_validee=false";

    return mysqli_query($connexion, $req);
}
