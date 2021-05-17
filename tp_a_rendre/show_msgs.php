<?php
require "dao.php";

$discussions = selectMessagesDiscussion("email1", "email2");
while ($value = mysqli_fetch_array($discussions)) {
    $emailSender = $value["email_envoyeur"];
    $emailReceiver = $value["email_receveur"];
    $msg = $value["message_text"];
    $date = $value["date_envoie"];

    echo "$emailSender to $emailReceiver, [$date] : $msg <br>";
}
?>