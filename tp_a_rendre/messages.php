<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="refresh_discussions.js"></script>
</head>

<?php
include "ban.php";
if (isset($_SESSION["email"], $_GET["receiver"]) and $_SESSION["email"] != NULL and  $_GET["receiver"] != NULL) {
    $sender = $_SESSION["email"];
    $receiver = $_GET["receiver"];
    $_SESSION["receiver"] = $_GET["receiver"];
    $dateTemp = "";
    $discussions = selectMessagesDiscussion($sender, $receiver);

    $membreSender = selectMembreWhereEmail($sender);
    $membreSender = mysqli_fetch_array($membreSender);
    $nomSender = $membreSender["nom"];
    $prenomSender = $membreSender["prenom"];

    $membreReceiver = selectMembreWhereEmail($receiver);
    $membreReceiver = mysqli_fetch_array($membreReceiver);
    $nomReceiver = $membreReceiver["nom"];
    $prenomReceiver = $membreReceiver["prenom"];

    echo "
        <div class='messageTo'><img src='" 
            .recupImageEmail($membreReceiver['adresse_mail']). 
            "' class='pdp'><h1>MESSAGE TO $nomReceiver $prenomReceiver</h1>
        </div>";

?>

    <body>
        <div id="show_msg" class="show_msg">
            <?php
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
                        <div class='containImg'><img src='" . recupImageEmail($_SESSION['email']) . "' class='pdp'>
                        </div>
                    </div>";
                } else {
                    echo "
                    <div class='youSend'>
                    <div class='containImg'><img src='" . recupImageEmail($membreSender['adresse_mail']) . "' class='pdp'>
                    </div>
                    <div class='containMsg'>
                        $msg 
                    </div> 
                    </div>";
                }
            }
            ?>
        </div>
        <div class="writeMsg">
            <form action="" method="POST">
                <input type="text" name="msg" class="write" placeholder="write your message here">
                <input type="submit" class="sub" value="send">
            </form>
        </div>
    </body>

</html>

<?php

    if (isset($_POST["msg"]) and $_POST["msg"] != NULL) {
        $msg = $_POST["msg"];

        insertIntoMessageDiscussion($sender, $receiver, $msg);
        
    }
} else {
    header("Location: login.php");
}
?>