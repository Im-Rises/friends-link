<?php 

session_start();

require "dao.php";

$idGroupe = $_SESSION["idGroupe"];


$messages = selectAllMessagesFromGroupeWhereId($idGroupe);
$dateTemp = "";

while ($value = mysqli_fetch_array($messages)) {
    $emailSender = $value["email_envoyeur"];

    $membreSender = selectMembreWhereEmail($emailSender);
    $membreSender = mysqli_fetch_array($membreSender);
    $nomSender = $membreSender["nom"];
    $prenomSender = $membreSender["prenom"];

    $msg = $value["text_message"];
    $date = $value["date_envoie"];
    if ($dateTemp != $date) {
        echo "<center>--------- $date ---------</center>";
        $dateTemp = $date;
    }
    if ($emailSender == $_SESSION["email"]) {
        echo "
    <div class='iSend'>
        <div class='containMsg'>
            $msg 
        </div>
        <div class='containImg'>
            " . recupImageEmail($_SESSION['email']) . "
        </div>
    </div>";
    } else {
        echo "
    <div class='youSend'>
        <div class='containImg'>
            " . recupImageEmail($membreSender['adresse_mail']) . "
        </div>
        <div class='containMsg'>
            $prenomSender $nomSender : $msg 
        </div>
    </div>";
    }
}

?>
