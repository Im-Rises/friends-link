<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
</head>

<?php
include "ban.php";
if (isset($_SESSION["email"], $_GET["receiver"]) and $_SESSION["email"] != NULL and  $_GET["receiver"] != NULL) {
    $sender = $_SESSION["email"];
    $receiver = $_GET["receiver"];
    $_SESSION["receiver"] = $_GET["receiver"];
?>

    <body>
        <div id="show_msg">
            <?php
            $discussions = selectMessagesDiscussion($sender, $receiver);
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
        </div>
        <div>
            <form action="" method="POST">
                <input type="text" name="msg">
                <input type="submit">
            </form>
        </div>
    </body>

</html>

<?php

    if (isset($_POST["msg"]) and $_POST["msg"] != NULL) {
        $msg = $_POST["msg"];

        insertIntoMessageDiscussion($sender, $receiver, $msg);
        header("Refresh:0");
    }
} else {
    header("Location: login.php");
}
?>