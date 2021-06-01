<?php include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <title>FriendsLink</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php include "search_peoples.php"; ?>

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
                        <td><img src='".recupImageEmail($emails['adresse_mail'])."' class='pdp'></div>
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
    header("Location: login.php");
}
?>