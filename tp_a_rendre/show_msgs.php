<?php
require "dao.php";

session_start();

$discussions = selectMessagesDiscussion($_SESSION["email"], $_SESSION["receiver"]);
$dateTemp = "";
while ($value = mysqli_fetch_array($discussions)) {
    $emailSender = $value["email_envoyeur"];

    $membreSender = selectMembreWhereEmail($emailSender);
    $membreSender = mysqli_fetch_array($membreSender);
    $nomSender = $membreSender["nom"];
    $prenomSender = $membreSender["prenom"];

    $emailReceiver = $value["email_receveur"];

    $membreReceiver = selectMembreWhereEmail($emailReceiver);
    $membreReceiver = mysqli_fetch_array($membreReceiver);
    $nomReceiver = $membreReceiver["nom"];
    $prenomReceiver = $membreReceiver["prenom"];

    $msg = $value["message_text"];
    $date = $value["date_envoie"];
    if($dateTemp != $date) {
        echo "<center>--------- $date ---------</center>";
        $dateTemp = $date;
    }
    if ($emailSender == $_SESSION["email"]) {
        echo "
        <div class='iSend'>
            $msg 
        </div>";
    } else {
        echo "
        <div class='youSend'>
        $msg 
        </div>";
    }
}

?>
