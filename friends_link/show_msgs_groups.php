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
        echo "<p class='center'>--------- $date ---------</p>";
        $dateTemp = $date;
    }
    if ($emailSender == $_SESSION["email"]) {
        echo "
    <div class='iSend'>
        <div class='containMsg'>
            $msg 
        </div>
        <div class='containImg'><img src='" . recupImageEmail($_SESSION['email']) . "' class='pdp'>
        </div>
    </div>";
    } else {
        echo "
    <div class='youSend'>
        <div class='containImg'><img src='" . recupImageEmail($membreSender['adresse_mail']) . "' class='pdp'>
        </div>
        <div class='containMsg'>
            $prenomSender $nomSender : $msg 
        </div>
    </div>";
    }
}
