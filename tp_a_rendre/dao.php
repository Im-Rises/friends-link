<?php
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "reseau_social";
$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);


function protection($val)
{
    $val = htmlspecialchars($val);
    $val = htmlentities($val);
    return $val;
}

function exeReq($req)
{
    global $connexion;

    $res = mysqli_query($connexion, $req);
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";

    return $res;
}
// INSERT

function insertIntoMembre($email, $nom, $prenom, $bday, $mdp) // works
{
    $email = protection($email);

    $nom = protection($nom);

    $prenom = protection($prenom); // protege des injections sql

    $bday = protection($bday); // protege des injections sql

    $mdp = protection($mdp); // protege des injections sql
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

    $req = "INSERT INTO membre(adresse_mail, nom, prenom, date_naissance, mdp) VALUES ('$email', '$nom', '$prenom', '$bday', '$mdp');";

    exeReq($req);
}

function insertIntoMessageDiscussion($sender, $receiver, $msg) // works
{
    $sender = protection($sender); // protege des injections sql

    $receiver = protection($receiver); // protege des injections sql

    $msg = protection($msg); // protege des injections sql

    $req = "INSERT INTO message_discussion(email_envoyeur, email_receveur, message_text, date_envoie) VALUES ('$sender', '$receiver', '$msg', CURRENT_DATE());";

    return exeReq($req);
}


function insertIntoAmi($email, $email_ami, $amitie_validee) // works
{
    $email = protection($email); // protege des injections sql

    $email_ami = protection($email_ami); // protege des injections sql

    $req = "INSERT INTO Ami VALUES ('$email', '$email_ami', '$amitie_validee', NOW())";

    return exeReq($req);
}

function selectIdFromGroupeWhereCreatorAndNameOfGroup($email, $name)
{
    $email = protection($email);

    $name = protection($name);

    $req = "SELECT id FROM groupe WHERE email_createur = '$email' AND nom = '$name';";

    return exeReq($req);
}

function insertIntoGroupe($nom, $email_createur) // works
{
    $nom = protection($nom); 

    $email_createur = protection($email_createur); 

    $req = "INSERT INTO Groupe(nom, email_createur) VALUES ('$nom', '$email_createur')";

    return exeReq($req);
}

function insertIntoGroupeMembre($id_groupe, $email_membre)
{
    $id_groupe = protection($id_groupe); // protege des injections sql

    $email_membre = protection($email_membre); // protege des injections sql

    $req = "INSERT INTO groupe_membre VALUES('$id_groupe', '$email_membre',NOW())";

    return exeReq($req);
}

function insertIntoMessageGroupe($email_envoyeur, $id_groupe, $message)
{
    $email_envoyeur = protection($email_envoyeur); // protege des injections sql

    $id_groupe = protection($id_groupe); // protege des injections sql

    $message = protection($message); // protege des injections sql

    $req = "INSERT INTO message_groupe(email_envoyeur, id_groupe, text_message, date_envoie) VALUES('$email_envoyeur','$id_groupe','$message', NOW());";

    return exeReq($req);
}

// SELECT
function selectMembreWhereEmail($email)
{
    $email = protection($email); // protege des injections sql

    $req = "SELECT * FROM membre WHERE adresse_mail = '$email';";

    return exeReq($req);
}

// recuperer donnees membres depuis email
function selectDataMembersWhereEmail($email)
{
    $email = protection($email); // protege des injections sql

    $req = "SELECT * FROM membre WHERE adresse_mail = '$email';";

    return exeReq($req);
}

// selectionner une discussion entre 2 emails
function selectMessagesWithTwoEmail($email1, $email2)
{
    $email1 = protection($email1); // protege des injections sql

    $email2 = protection($email2); // protege des injections sql

    $req = "SELECT  *
            FROM message_discussion
            WHERE email_envoyeur='$email1' 
            AND email_receveur='$email2' 
            UNION 
            SELECT  *
            FROM message_discussion
            WHERE email_envoyeur='$email2' 
            AND email_receveur='$email1';";


    return exeReq($req);
}

// selectionner tous les amis d'un email
function selectAllFriendsWhereEmail($email)
{
    $email = protection($email); // protege des injections sql

    $req = "SELECT * FROM membre m JOIN ami a ON a.email_ami = m.adresse_mail WHERE a.email='$email' AND a.amitie_validee=1;";

    return exeReq($req);
}

function selectAllMembersWhereNomPrenomEmailWhereSearch($search, $email)
{
    $search = protection($search); // protege des injections sql

    $req = "SELECT DISTINCT *
            FROM membre m
            WHERE LOCATE('$search', adresse_mail) 
                OR LOCATE('$search', nom) 
                OR LOCATE('$search', prenom) 
                OR LOCATE('$search', CONCAT(prenom, ' ', nom)) 
                OR LOCATE('$search', CONCAT(nom, ' ', prenom));";

    return exeReq($req);
}

// Selection des discussions
function selectEmailsDiscussion($email)
{
    $email = protection($email);

    $req = "SELECT * FROM membre m JOIN message_discussion md ON md.email_receveur = m.adresse_mail WHERE md.email_receveur = '$email';";

    return exeReq($req);
}

function selectMessagesDiscussion($email1, $email2)
{
    $email1 = protection($email1);

    $email2 = protection($email2);

    $req = "SELECT * FROM message_discussion WHERE email_envoyeur='$email1' AND email_receveur='$email2' UNION SELECT * FROM message_discussion WHERE email_envoyeur='$email2' AND email_receveur='$email1' ORDER BY id_message;";

    return exeReq($req);
}


// Selection des groupes
function selectAllGroupes($email)
{
    $email = protection($email);

    $req = "SELECT * FROM groupe g JOIN groupe_membre gm ON gm.id_groupe = g.id WHERE mail_membre = '$email';";

    return exeReq($req);
}

function selectAllMessagesFromGroupeWhereId($id)
{
    $id = protection($id);

    $req = "SELECT * FROM message_groupe mg JOIN groupe g ON g.id = mg.id_groupe WHERE mg.id_groupe = '$id';";

    return exeReq($req);
}


function selectMembresGroupe($id_groupe)
{
    $req = "SELECT mail_membre FROM groupeMembre WHERE id_groupe='$id_groupe';";

    return exeReq($req);
}

function selectMessagesGroupe($idGroup)
{
    $req = "SELECT * FROM message_groupe WHERE id_groupe='$idGroup';";

    return exeReq($req);
}

// Recuperer les demandes d'ami reçues
function selectDemandesAmi($email)
{
    $email = protection($email);

    $req = "SELECT email_ami FROM ami WHERE email='$email' AND amitie_validee=false";

    return exeReq($req);
}




/*---------------------------------Créer demande d'ami---------------------------*/

//Créer une demande d'ami
function insertIntoAmiDemandeAmi($emailDemandeur, $emailReceveur)
{
    $emailDemandeur = protection($emailDemandeur);

    $emailReceveur = protection($emailReceveur);

    $req = "INSERT INTO ami VALUES ('$emailDemandeur', '$emailReceveur', 0, NOW())";

    return exeReq($req);
}

//Voir si un profil consulté est demandé en ami (pour voir si une personne a demandé l'utilisatuer en ami inverser les variables)
function selectProfilDemandeEnAmi($emailDemandeur, $emailProfilRegarde)
{
    $emailDemandeur = protection($emailDemandeur);

    $req = "SELECT amitie_validee FROM ami WHERE email=$emailDemandeur AND email_ami=$emailProfilRegarde";

    return exeReq($req);
}


//Voir les profils demandés en ami
function selectProfilsEnvoieDemandesEnAmi($emailDemandeur)
{
    $emailDemandeur = protection($emailDemandeur);

    $req = "SELECT * FROM membre WHERE adresse_mail IN (SELECT email_ami FROM ami WHERE email='$emailDemandeur' AND amitie_validee=0);";

    return exeReq($req);
}

//Voir les amitiés reçues
function selectProfilsReceptionDemandeAmi($email)
{
    $email = protection($email);

    $req = "SELECT * FROM membre WHERE adresse_mail IN (SELECT email FROM ami WHERE email_ami='$email' AND amitie_validee=0);";

    return exeReq($req);
}


//Crer l'amitié
function creerAmitie($emailDemandeur, $emailAccepteur)
{
    global $connexion;

    $emailDemandeur = protection($emailDemandeur);

    $emailAccepteur = protection($emailAccepteur);

    $req = "UPDATE ami SET amitie_validee=1 WHERE email='$emailDemandeur' AND email_ami='$emailAccepteur';";

    $res = mysqli_query($connexion, $req);
    if (!$res) {
        echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";
    } else {
        insertIntoAmi($emailAccepteur, $emailDemandeur, 1);
    }

    return $res;
}

//Refuser une demande d'ami
function annulerDemandeAmi($emailDemandeur, $emailReceveur)
{
    $emailDemandeur = protection($emailDemandeur);

    $emailReceveur = protection($emailReceveur);

    $req = "DELETE FROM ami WHERE email='$emailDemandeur' AND email_ami='$emailReceveur';";

    return exeReq($req);
}
