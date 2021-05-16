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
    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function insertIntoMessageDiscussion ($sender, $receiver, $msg) {
    global $connexion;

    $sender = htmlspecialchars($sender); // protege des injections de code html ou js
    $sender = htmlentities($sender); // protege des injections sql

    $receiver = htmlspecialchars($receiver); // protege des injections de code html ou js
    $receiver = htmlentities($receiver); // protege des injections sql

    $msg = htmlspecialchars($msg); // protege des injections de code html ou js
    $msg = htmlentities($msg); // protege des injections sql

    $req = "INSERT INTO message_discussion(email_envoyeur, email_receveur, message_text, date_envoie) VALUES ('$sender', '$receiver', '$msg', CURRENT_DATE());";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function insertIntoAmi($email, $email_ami, $amitie_validee)
{
    global $connexion;

    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql
    
    $email_ami = htmlspecialchars($email_ami); // protege des injections de code html ou js
    $email_ami = htmlentities($email_ami); // protege des injections sql
    
    //$sender = htmlspecialchars($amitie_validee); // protege des injections de code html ou js
    //$sender = htmlentities($amitie_validee); // protege des injections sql

    $req="INSERT INTO Ami VALUES ($email, $email_ami, $amitie_validee)";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function insertIntoGroupe($nom)
{
    global $connexion;

    $nom = htmlspecialchars($nom); // protege des injections de code html ou js
    $nom = htmlentities($nom); // protege des injections sql

    $req="INSERT INTO Groupe VALUES (NULL, $nom)";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function insertIntoGroupeMembre($id_groupe, $email_membre)
{
    global $connexion;

    $id_groupe = htmlspecialchars($id_groupe); // protege des injections de code html ou js
    $id_groupe = htmlentities($id_groupe); // protege des injections sql

    $email_membre = htmlspecialchars($email_membre); // protege des injections de code html ou js
    $email_membre = htmlentities($email_membre); // protege des injections sql

    $req="INSERT INTO groupe_membre VALUES($id_groupe, $email_membre,NOW())";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function insertIntoMessageGroupe($email_envoyeur, $id_groupe, $message)
{
    global $connexion;

    $email_envoyeur = htmlspecialchars($email_envoyeur); // protege des injections de code html ou js
    $email_envoyeur = htmlentities($email_envoyeur); // protege des injections sql

    $id_groupe = htmlspecialchars($id_groupe); // protege des injections de code html ou js
    $id_groupe = htmlentities($id_groupe); // protege des injections sql

    $message = htmlspecialchars($message); // protege des injections de code html ou js
    $message = htmlentities($message); // protege des injections sql

    $req="INSERT INTO message_groupe VALUES($email_envoyeur,$id_groupe,$message, NOW())";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

// SELECT

// recuperer donnees membres depuis email
function selectDataMembersWhereEmail($email)
{
    global $connexion;

    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql

    $req = "SELECT * FROM membre WHERE adresse_mail = '$email';";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

// selectionner une discussion entre 2 emails
function selectMessagesWithTwoEmail($email1, $email2)
{
    global $connexion;

    $email1 = htmlspecialchars($email1); // protege des injections de code html ou js
    $email1 = htmlentities($email1); // protege des injections sql

    $email2 = htmlspecialchars($email2); // protege des injections de code html ou js
    $email2 = htmlentities($email2); // protege des injections sql

    $req = "SELECT  *
            FROM message_discussion
            WHERE email_envoyeur='$email1' 
            AND email_receveur='$email2' 
            UNION 
            SELECT  *
            FROM message_discussion
            WHERE email_envoyeur='$email2' 
            AND email_receveur='$email1';";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

// selectionner tous les amis d'un email
function selectAllFriendsWhereEmail($email)
{
    global $connexion;

    $email = htmlspecialchars($email); // protege des injections de code html ou js
    $email = htmlentities($email); // protege des injections sql

    $req = "SELECT * FROM ami WHERE email='$email' AND amitiee=true;";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

// Selection des discussion
function selectEmailsDiscussion($email)
{
    global $connexion;

    $email = htmlspecialchars($email);
    $email = htmlentities($email);

    $req = "SELECT email_receveur FROM message_discussion WHERE email_envouyeur='$email' UNION SELECT email_envoyeur FROM message_discussion WHERE email_receveur='$email';";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function selectMessagesDiscussion($email1, $email2)
{
    global $connexion;

    $email1 = htmlspecialchars($email1);
    $email1 = htmlentities($email1);

    $email2 = htmlspecialchars($email2);
    $email2 = htmlentities($email2);

    $req = "SELECT * FROM message_discussion WHERE email_envoyeur='$email1' AND email_receveur='$email2' UNION SELECT * FROM message_discussion WHERE email_envoyeur='$email2' AND email_receveur='$email1';";
    
    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}


// Selection des groupes
function selectAllGroupes($email)
{
    global $connexion;

    $email = htmlspecialchars($email);
    $email = htmlentities($email);

    $req = "SELECT DISTINCT id_groupe  FROM message_groupe WHERE mail_membre='$email';";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function selectMembresGroupe($id_groupe)
{
    global $connexion;

    $req = "SELECT mail_membre FROM groupeMembre WHERE id_groupe='$id_groupe';";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

function selectMessagesGroupe($idGroup)
{
    global $connexion;

    $req = "SELECT * FROM message_groupe WHERE id_groupe='$idGroup';";

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}

// Recuperer les demandes d'ami reçues
function selectDemandesAmi($email)
{
    global $connexion;

    $email = htmlspecialchars($email);
    $email = htmlentities($email);

    $req = "SELECT email_ami FROM ami WHERE email='$email' AND amitie_validee=false";
    
    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    return $res;
}
