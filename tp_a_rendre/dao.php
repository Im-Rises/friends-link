<?php
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "reseau_social";
$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);

// OTHERS
function protection($val) // permet de centraliser toute la protection de nos variables lors de requêtes sql
{
    $val = htmlspecialchars($val); // protection contre les codes html / css / js
    $val = htmlentities($val); // protection contre les injections sql
    return $val;
}

function exeReq($req) // permet de centraliser l'execution d'une requete
{
    global $connexion;

    $res = mysqli_query($connexion, $req); // on execute la requete

    // une fois la requete executee, on regarde s'il n'y a pas eu d'erreur, sinon on affiche cette erreur
    if (!$res) echo mysqli_errno($connexion) . ": " . mysqli_error($connexion) . "\n";

    // on retourne le résultat
    return $res;
}

function isAdmin($admins, $email) // permet de verifier qu'un email est bien contenu dans une une liste d'administrateurs
{
    while ($membre = mysqli_fetch_array($admins))
        if ($membre["email"] == $email) return true;
    return false;
}




// REQUETES DE LA BASE DE DONNEES

function insertIntoMembre($email, $nom, $prenom, $bday, $mdp) // works
{
    $email = protection($email);

    $nom = protection($nom);

    $prenom = protection($prenom); // protege des injections sql

    $bday = protection($bday); // protege des injections sql

    $mdp = protection($mdp); // protege des injections sql

    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

    $req = "INSERT INTO membre(adresse_mail, nom, prenom, date_naissance, mdp) VALUES (\"$email\", \"$nom\", \"$prenom\", \"$bday\", \"$mdp\");";

    return exeReq($req);
}

function insertIntoMessageDiscussion($sender, $receiver, $msg) // works
{
    $sender = protection($sender); // protege des injections sql

    $receiver = protection($receiver); // protege des injections sql

    $msg = protection($msg); // protege des injections sql

    $req = "INSERT INTO message_discussion(email_envoyeur, email_receveur, message_text, date_envoie) VALUES (\"$sender\", \"$receiver\", \"$msg\", CURRENT_DATE());";

    return exeReq($req);
}


function insertIntoAmi($email, $email_ami, $amitie_validee) // works
{
    $email = protection($email); // protege des injections sql

    $email_ami = protection($email_ami); // protege des injections sql

    $req = "INSERT INTO Ami VALUES (\"$email\", \"$email_ami\", \"$amitie_validee\", NOW())";

    return exeReq($req);
}

//Création d'un groupe dans al table groupe
function insertIntoGroupe($nom, $email_createur) // works
{
    $nom = protection($nom);

    $email_createur = protection($email_createur);

    $req = "INSERT INTO Groupe(nom, email_createur) VALUES (\"$nom\", \"$email_createur\")";

    return exeReq($req);
}

//Ajout d'un membre a un groupe
function insertIntoGroupeMembre($id_groupe, $email_membre)
{
    $id_groupe = protection($id_groupe); // protege des injections sql

    $email_membre = protection($email_membre); // protege des injections sql

    $req = "INSERT INTO groupe_membre VALUES(\"$id_groupe\", \"$email_membre\",NOW())";

    return exeReq($req);
}

//Ajout d'un message dans un groupe
function insertIntoMessageGroupe($email_envoyeur, $id_groupe, $message)
{
    $email_envoyeur = protection($email_envoyeur); // protege des injections sql

    $id_groupe = protection($id_groupe); // protege des injections sql

    $message = protection($message); // protege des injections sql

    $req = "INSERT INTO message_groupe(email_envoyeur, id_groupe, text_message, date_envoie) VALUES(\"$email_envoyeur\",\"$id_groupe\",\"$message\", NOW());";

    return exeReq($req);
}


//Ajout d'un admin au groupe
function insertIntoAdmin($idGroupe, $email)
{
    $idGroupe = protection($idGroupe);

    $email = protection($email);

    $req = "INSERT INTO admin_groupe(email, id_groupe) VALUES (\"$email\", \"$idGroupe\");";

    return exeReq($req);
}


//Ajout d'un like à un post
function insertIntoLikes($id_post, $email)
{
    $id_post = protection($id_post);

    $email = protection($email);

    $req = "INSERT INTO post_like(id_post, adresse_mail) VALUES (\"$id_post\", \"$email\");";

    return exeReq($req);
}


//Récupère si un post a été liké par l'adresse_mail
function selectLikesWhereEmailAndId($email, $id_post)
{
    $id_post = protection($id_post);

    $email = protection($email);

    $req = "SELECT * FROM post_like WHERE id_post=\"$id_post\" AND adresse_mail=\"$email\";";

    return exeReq($req);
}

//Récupère l'id des groupes où le nom du créateur a l'adresse mail et le nom du groupe envoyé en paramètre
function selectIdFromGroupeWhereCreatorAndNameOfGroup($email, $name)
{
    $email = protection($email);

    $name = protection($name);

    $req = "SELECT id FROM groupe WHERE email_createur = \"$email\" AND nom = \"$name\";";

    return exeReq($req);
}

//Récupère l'utilisateur qui a l'adresse mail envoyé en paramètre 
function selectMembreWhereEmail($email)
{
    $email = protection($email); // protege des injections sql

    $req = "SELECT * FROM membre WHERE adresse_mail = \"$email\";";

    return exeReq($req);
}

// recuperer les donnees membres depuis email
function selectDataMembersWhereEmail($email)
{
    $email = protection($email); // protege des injections sql

    $req = "SELECT * FROM membre WHERE adresse_mail = \"$email\";";

    return exeReq($req);
}

// selectionner une discussion entre 2 emails
function selectMessagesWithTwoEmail($email1, $email2)
{
    $email1 = protection($email1); // protege des injections sql

    $email2 = protection($email2); // protege des injections sql

    $req = "SELECT  *
            FROM message_discussion
            WHERE email_envoyeur=\"$email1\" 
            AND email_receveur=\"$email2\" 
            UNION 
            SELECT  *
            FROM message_discussion
            WHERE email_envoyeur=\"$email2\" 
            AND email_receveur=\"$email1\";";


    return exeReq($req);
}

// selectionner tous les amis d\"un email
function selectAllFriendsWhereEmail($email)
{
    $email = protection($email); // protege des injections sql

    $req = "SELECT * FROM membre m JOIN ami a ON a.email_ami = m.adresse_mail WHERE a.email=\"$email\" AND a.amitie_validee=1;";

    return exeReq($req);
}

//Cherche les personnes dans la base de données en se basant sur la recherche envoyé en paramètre
function selectAllMembersWhereNomPrenomEmailWhereSearch($search, $email)
{
    $search = protection($search); // protege des injections sql

    $search = "$search%";

    $req = "SELECT DISTINCT * FROM membre m WHERE 
    UPPER(adresse_mail) LIKE UPPER('$search')
    OR UPPER(nom) LIKE UPPER('$search')
    OR UPPER(prenom) LIKE UPPER('$search');";

    return exeReq($req);
}

function selectAllMembersNotFriends($search, $email_session)
{
    $search = protection($search);

    $search = "$search%";

    $email_session = protection($email_session);

    $req = "SELECT * FROM membre WHERE 
            adresse_mail NOT IN ( 
                SELECT email_ami FROM ami WHERE amitie_validee=1 AND email='$email_session' 
            ) AND adresse_mail!='$email_session'
            AND (UPPER(adresse_mail) LIKE UPPER('$search')
            OR UPPER(nom) LIKE UPPER('$search')
            OR UPPER(prenom) LIKE UPPER('$search'));";

    return exeReq($req);
}

function selectAllMembersWhoLikeIdPost($id_post) // on recupere toutes les personnes qui ont likés un post spécifique
{
    $id_post = protection($id_post);

    $req = "SELECT DISTINCT nom, prenom FROM membre m JOIN post_like pl ON pl.adresse_mail = m.adresse_mail WHERE pl.id_post = '$id_post';";

    return exeReq($req);
}

// Selection des discussions en fonction de l'adresse_mail envoyé en paramètre
function selectEmailsDiscussion($email)
{
    $email = protection($email);

    $req = "SELECT * FROM membre m JOIN message_discussion md ON md.email_receveur = m.adresse_mail WHERE md.email_receveur = \"$email\";";

    return exeReq($req);
}

//Récupère les messages d'une discussion en fonction des deux utilisateurs envoyé en paramètre
function selectMessagesDiscussion($email1, $email2)
{
    $email1 = protection($email1);

    $email2 = protection($email2);

    $req = "SELECT * FROM message_discussion WHERE email_envoyeur=\"$email1\" AND email_receveur=\"$email2\" UNION SELECT * FROM message_discussion WHERE email_envoyeur=\"$email2\" AND email_receveur=\"$email1\" ORDER BY id_message;";

    return exeReq($req);
}

//Récupère les données du groupe en fonction de l'id du groupe envoyé en paramètre
function selectGroupeWhereId($id)
{
    $id = protection($id);

    $req = "SELECT * FROM groupe WHERE id=\"$id\";";

    return exeReq($req);
}

// Selection des groupes dun membre en fonction de son email
function selectAllGroupes($email)
{
    $email = protection($email);

    $req = "SELECT * FROM groupe g JOIN groupe_membre gm ON gm.id_groupe = g.id WHERE mail_membre = \"$email\";";

    return exeReq($req);
}

//Récupère tous les messages d'un groupe en fonction de l'id du groupe
function selectAllMessagesFromGroupeWhereId($id)
{
    $id = protection($id);

    $req = "SELECT * FROM message_groupe mg JOIN groupe g ON g.id = mg.id_groupe WHERE mg.id_groupe = \"$id\";";

    return exeReq($req);
}

//Récupère les membres du groupes en fonction de l'id du groupe
function selectMembresGroupe($id_groupe)
{
    $req = "SELECT * FROM membre m JOIN groupe_membre gm ON gm.mail_membre = m.adresse_mail WHERE gm.id_groupe = \"$id_groupe\";";

    return exeReq($req);
}

//Récupère tous les noms du groupe
function selectAllAdmin($idGroupe)
{
    $req = "SELECT DISTINCT *
        FROM membre
        WHERE adresse_mail IN (SELECT email FROM admin_groupe WHERE id_groupe=\"$idGroupe\");";

    return exeReq($req);
}

//Récupère les membres du groupe qui ne sont pas administrateur du groupe
function selectMembresNotInAdminWhereIdGroupe($search, $idGroupe)
{
    $search = protection($search);

    $search = "%$search%";

    $req = "SELECT DISTINCT *
            FROM membre
            WHERE adresse_mail IN (SELECT mail_membre FROM groupe_membre WHERE id_groupe = \"$idGroupe\")
            AND adresse_mail NOT IN (SELECT email FROM admin_groupe WHERE id_groupe=\"$idGroupe\")
            AND (UPPER(adresse_mail) LIKE UPPER('$search')
            OR UPPER(nom) LIKE UPPER('$search')
            OR UPPER(prenom) LIKE UPPER('$search'));";

    return exeReq($req);
}

//Récupère les personnes non présentes dans le groupe envoyé en paramètre en foncton de la recherche envoyée en paramètre
function selectMembresNotInGroupeWhereIdGroupe($search, $idGroupe)
{

    $search = protection($search);

    $search = "%$search%";

    $req = "SELECT DISTINCT *
            FROM membre
            WHERE 
            adresse_mail NOT IN (SELECT mail_membre FROM groupe_membre WHERE id_groupe=\"$idGroupe\")
            AND 
            (UPPER(adresse_mail) LIKE UPPER('$search')
            OR UPPER(nom) LIKE UPPER('$search')
            OR UPPER(prenom) LIKE UPPER('$search'));";

    return exeReq($req);
}

//Récupère les messages d'un groupe
function selectMessagesGroupe($idGroup)
{
    $req = "SELECT * FROM message_groupe WHERE id_groupe=\"$idGroup\";";

    return exeReq($req);
}

// Recuperer les demandes d'ami reçues
function selectDemandesAmi($email)
{
    $email = protection($email);

    $req = "SELECT email_ami FROM ami WHERE email=\"$email\" AND amitie_validee=false";

    return exeReq($req);
}

//récupre les adresse mail des membres d'un groupe qui sont administrateurs
function selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe)
{
    $idGroupe = protection($idGroupe);

    $req = "SELECT email FROM admin_groupe WHERE id_groupe=\"$idGroupe\"";

    return exeReq($req);
}




/*---------------------------------Créer demande d\"ami---------------------------*/

//Créer une demande d'ami
function insertIntoAmiDemandeAmi($emailDemandeur, $emailReceveur)
{
    $emailDemandeur = protection($emailDemandeur);

    $emailReceveur = protection($emailReceveur);

    $req = "INSERT INTO ami VALUES (\"$emailDemandeur\", \"$emailReceveur\", 0, NOW())";

    return exeReq($req);
}

//Voir si un profil consulté est demandé en ami (pour voir si une personne a demandé l\"utilisatuer en ami inverser les variables)
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

    $req = "SELECT * FROM membre WHERE adresse_mail IN (SELECT email_ami FROM ami WHERE email=\"$emailDemandeur\" AND amitie_validee=0);";

    return exeReq($req);
}

//Voir les amitiés reçues
function selectProfilsReceptionDemandeAmi($email)
{
    $email = protection($email);

    $req = "SELECT * FROM membre WHERE adresse_mail IN (SELECT email FROM ami WHERE email_ami=\"$email\" AND amitie_validee=0);";

    return exeReq($req);
}


//Crer une amitié en fonction de deux adresses mail envoyé en paramètre
function updateToRealAmitie($emailDemandeur, $emailAccepteur)
{
    global $connexion;

    $emailDemandeur = protection($emailDemandeur);

    $emailAccepteur = protection($emailAccepteur);

    $req = "UPDATE ami SET amitie_validee=1 WHERE email=\"$emailDemandeur\" AND email_ami=\"$emailAccepteur\";";

    $res = mysqli_query($connexion, $req);

    return $res;
}

//Refuser une demande d'ami
function annulerDemandeAmi($emailDemandeur, $emailReceveur)
{
    $emailDemandeur = protection($emailDemandeur);

    $emailReceveur = protection($emailReceveur);

    $req = "DELETE FROM ami WHERE email=\"$emailDemandeur\" AND email_ami=\"$emailReceveur\";";

    return exeReq($req);
}

//Supprimer un membre d'un groupe
function deleteFromGroupeMembreWhereEmail($email, $idGroupe)
{
    $email = protection($email);

    $req = "DELETE FROM groupe_membre WHERE id_groupe = \"$idGroupe\" AND mail_membre = \"$email\";";

    return exeReq($req);
}

//Supprimer un like d'un post en fonction de l'id du groupe et de l'email
function deleteLikeWhereEmailAndIdPost($id_post, $email)
{
    $id_post = protection($id_post);

    $email = protection($email);

    $req = "DELETE FROM post_like WHERE adresse_mail = \"$email\" AND id_post = \"$id_post\";";

    return exeReq($req);
}



//Changer le nom du groupe sélectionné par son id envoyé en paramètre
function updateNomGroupe($nomGroupe, $idGroupe)
{
    $nomGroupe = protection($nomGroupe);

    $idGroupe = protection($idGroupe);

    $req = "UPDATE groupe SET nom=\"$nomGroupe\" WHERE id=\"$idGroupe\";";

    return exeReq($req);
}


//Récupère tous les posts d'une adresse mail par date (plus récent au plus vieux)
function selectAllPostsFromMembreOrder($email)
{
    $email = protection($email);

    $req = "SELECT * FROM post WHERE email_posteur=\"$email\" ORDER BY datePost;";

    return exeReq($req);
}

function countDemandeAmis($email)
{
    $email = protection($email);

    $req = "SELECT COUNT(*) FROM ami WHERE amitie_validee=0;";

    return exeReq($req);
}

//Récupère tous les messages d'un post par date en fonction de l'id du post
function selectAllMessagesFromPostOrder($idPost)
{
    $idPost = protection($idPost);

    $req = "SELECT * FROM post_message WHERE id_post=$idPost ORDER BY datePost;";

    return exeReq($req);
}

//Création d'un post
function insertIntoPost($email_auteur, $titre, $message, $imagePoste)
{
    $email_auteur = protection($email_auteur);
    $titre = protection($titre);
    $message = protection($message);
    $imagePoste = protection($imagePoste);

    $req = "INSERT INTO post VALUES (NULL, \"$email_auteur\",\"$titre\", NOW(), \"$message\", $imagePoste);";

    return exeReq($req);
}

//récupère tous les posts de tous les amis de l'utilisateur envoyé en paramètre
function selectPostsFromAmis($emailUtilisateur)
{
    $emailUtilisateur = protection($emailUtilisateur);

    $req = "SELECT * FROM post WHERE email_posteur IN (SELECT email_ami FROM ami WHERE amitie_validee=1 AND email=\"$emailUtilisateur\") ORDER BY datePost DESC;";

    return exeReq($req);
}

//récupère un post en se basant sur l'id du post envoyé en paramètre
function selectPostsFromId($id_post)
{
    $id_post = protection($id_post);

    $req = "SELECT * FROM post WHERE id_post=$id_post;";

    return exeReq($req);
}

//Récupère le dernier id du post créé par l'utilisateur
function selectLastPostIdMembre($email)
{
    $email = protection($email);

    $req = "SELECT id_post FROM post WHERE email_posteur=\"$email\" AND datePost >= ALL (SELECT datePost FROM post WHERE email_posteur=\"$email\");";

    return exeReq($req);
}

//Création d'un message de commentaire à un post
function insertIntoPost_Message($id_post, $email_posteur, $message_post)
{
    $id_post = protection($id_post);
    $email_posteur = protection($email_posteur);
    $message_post = protection($message_post);

    $req = "INSERT INTO post_message VALUES (NULL,$id_post, \"$email_posteur\", NOW(), \"$message_post\");";

    return exeReq($req);
}

//Récupère tous les messages d'un post en fonction de l'id du post envoyé en paramètre
function selectMessagesFromPost($id_post)
{
    $id_post = protection($id_post);

    $req = "SELECT M.adresse_mail, M.nom, M.prenom, PM.message_post_text, PM.datePost FROM membre M JOIN post_message PM ON M.adresse_mail=PM.email_posteur WHERE PM.id_post=$id_post ORDER BY datePost DESC;";

    return exeReq($req);
}

function countLikesFromIdPost($id_post)
{
    $id_post = protection($id_post);

    $req = "SELECT COUNT(*) FROM post_like WHERE id_post=\"$id_post\"";

    return exeReq($req);
}

//Verifie qu'un post existe en envoyant son id en paramètre
function verifPostExiste($id_post)
{
    $id_post = protection($id_post);

    $req = "SELECT 1 FROM post WHERE id_post=$id_post;";

    return exeReq($req);
}

function verifEmailExiste($email)
{
    $email = protection($email);

    $req = "SELECT 1 FROM membre WHERE adresse_mail='$email';";
    //$req="SELECT 1 FROM membre WHERE adresse_mail='quentin.orel@esme.fr';";

    return exeReq($req);
}

//Mise à jour du nom pour le changement de l'image d'un membre
function updateImageMembre($email, $nomImage)
{
    $email = protection($email);

    $nomImage = protection($nomImage);

    $req = "UPDATE membre SET nomImage=\"$nomImage\" WHERE adresse_mail=\"$email\";";

    return exeReq($req);
}


//Fonction de récuépration de l'image de l'adresse email envoyé en paramètre
function recupImageEmail($email)
{
    $nomImage = selectNomImageFromEmail($email);

    if ($nomImage["nomImage"] != NULL and file_exists("images/profiles/$nomImage[nomImage]")) {
        $image = "images/profiles/$nomImage[nomImage]";
    } else {
        $image = "images/profiles/unknown.png";
    }

    return $image;
}

//Récupère le nom de 'image de l'utilisateur envoyé en paramètre 
function selectNomImageFromEmail($email)
{
    $email = protection($email);

    $req = "SELECT nomImage FROM membre WHERE adresse_mail=\"$email\";";

    return mysqli_fetch_array(exeReq($req));
}



//Récupère le nom de l'image d'un groupe en fonction de l'id du groupe
function recupImageGroupe($idGroupe)
{
    $nomImage = selectNomImageFromGroupe($idGroupe);

    if ($nomImage["nomImage"] != NULL and file_exists("images/groupes/$nomImage[nomImage]")) {
        $chemin = "images/groupes/$nomImage[nomImage]";
    } else {
        $chemin = "images/groupes/unknown.png";
    }

    return $chemin;
}


//Mise à jour du nom de l'image d'un groupe pour le changement d'image
function updateImageGroupe($idGroupe, $nomImage)
{
    $idGroupe = protection($idGroupe);

    $nomImage = protection($nomImage);

    $req = "UPDATE groupe SET nomImage=\"$nomImage\" WHERE id=\"$idGroupe\";";

    return exeReq($req);
}

//Récupère le nom de l'image du groupe 
function selectNomImageFromGroupe($idGroupe)
{
    $idGroupe = protection($idGroupe);

    $req = "SELECT nomImage FROM groupe WHERE id=\"$idGroupe\";";

    return mysqli_fetch_array(exeReq($req));
}

//Supprime une aimitié entre deux membres
function deleteAmitie($emailUtilisateur, $emailAmi)
{

    $emailUtilisateur = protection($emailUtilisateur);
    $emailAmi = protection($emailAmi);

    $req = "DELETE FROM ami WHERE email=\"$emailUtilisateur\" AND email_ami=\"$emailAmi\";";

    exeReq($req);

    $req = "DELETE FROM ami WHERE email=\"$emailAmi\" AND email_ami=\"$emailUtilisateur\";";

    exeReq($req);
}
