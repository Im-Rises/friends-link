<?php 
session_start();
include "dao.php";
//Si utilisateur connecté, affichage de la page
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <title>FriendsLink</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
        <?php
        $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
        echo "<link rel='stylesheet' href='$css'>";
        ?>
    </head>

    <?php  include "ban.php";?>

    <body>
        <!-- Ajout de la page pour la recherche de personnes -->
        <?php include "search_peoples.php"; ?>

        <!-- Affiche la liste des demandes d'ami reçues en fonction de la personne connectée -->
        <h1>Liste des demandes d'amis reçues :</h1>
        <table style="width:100%">
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php
            $res = selectProfilsReceptionDemandeAmi($_SESSION["email"]);

            foreach ($res as $emails) {
                echo "
                    <br>
                    <tr>
                        <td><img src='" . recupImageEmail($emails['adresse_mail']) . "' class='pdp'></div>
                        <td>$emails[prenom]</td>
                        <td>$emails[nom]</td>
                        <td>$emails[adresse_mail]</td>
                        <td>
                            <a href='?methode=Accepter&idUtilisateurAutre=$emails[adresse_mail]' >Accepter</a>
                            <a href='?methode=Supprimer&idUtilisateurAutre=$emails[adresse_mail]' >Refuser</a>
                        </td>
                    </tr>
            ";
            }
            ?>
        </table>


        <!-- Affiche la liste des demandes d'ami envoyées en fonction de la personne connectée -->
        <h1>Liste des demandes d'amis envoyées :</h1>
        <table style="width:100%">
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php
            $res = selectProfilsEnvoieDemandesEnAmi($_SESSION["email"]);
            foreach ($res as $emails) {
                echo "
                    <br>
                    <tr>
                        <td><img src='" . recupImageEmail($emails['adresse_mail']) . "' class='pdp'></div>
                        <td>$emails[prenom]</td>
                        <td>$emails[nom]</td>
                        <td>$emails[adresse_mail]</td>
                        <td>
                            <a href='?methode=Annuler&idUtilisateurAutre=$emails[adresse_mail]' >Annuler</a>
                        </td>
                    </tr>
            ";
            }
            ?>
        </table>
    </body>

    </html>




    <?php
    //gestion des demandes d'amis reçues (accepter, refuser une demander d'ami, et annuler une demande d'ami envoyé)
    if (isset($_GET['methode'], $_GET['idUtilisateurAutre']) && $_GET['methode'] != NULL && $_GET['idUtilisateurAutre'] != NULL) {

        $methode = $_GET['methode'];
        $idUtilisateur = $_SESSION["email"];
        $idUtilisateurAutre = $_GET['idUtilisateurAutre'];

        switch ($_GET['methode']) {
            case 'Accepter': {
                    updateToRealAmitie($idUtilisateurAutre, $idUtilisateur);
                    insertIntoAmi($idUtilisateur, $idUtilisateurAutre, 1);
                }
                break;
            case 'Supprimer': {
                    annulerDemandeAmi($idUtilisateurAutre, $idUtilisateur);
                }
                break;
            case 'Annuler': {
                    annulerDemandeAmi($idUtilisateur, $idUtilisateurAutre);
                }
                break;
        }
        header("Location: friendsRequest.php");
    }
    ?>

<?php
} else {
    header("Location: login.php"); //Retour à la page de connexion si l'utilisateur n'est pas connecté
}
?>