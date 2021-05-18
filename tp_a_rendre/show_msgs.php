<?php
require "dao.php";

session_start();

$discussions = selectMessagesDiscussion($_SESSION["email"], $_SESSION["receiver"]);
while ($value = mysqli_fetch_array($discussions)) {
    $emailSender = $value["email_envoyeur"];
    $emailReceiver = $value["email_receveur"];
    $msg = $value["message_text"];
    $date = $value["date_envoie"];

    if ($emailSender == $_SESSION["email"]) {
        echo "
        <div class='iSend'>
            $emailSender to $emailReceiver, [$date] : <br> $msg 
        </div>";
    } else {
        echo "
        <div class='youSend'>
            $emailSender to $emailReceiver, [$date] : <br> $msg 
        </div>";
    }
}

?>
