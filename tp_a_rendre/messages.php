<?php
session_start();
if(isset($_SESSION["email"]) and $_SESSION["email"]!= NULL){
    $sender = $_SESSION["email"];
    $receiver = $_GET["receiver"];

    require "dao.php";
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="script.js"></script>
    </head>

    <body>
        <div id="show_msg">
            <?php 
            $discussions = selectMessagesDiscussion($sender, $receiver);
            while ($value = mysqli_fetch_array($discussions)) {
                $emailSender = $value["email_envoyeur"];
                $emailReceiver = $value["email_receveur"];
                $msg = $value["message_text"];
                $date = $value["date_envoie"];

                echo "$emailSender to $emailReceiver, [$date] : $msg <br>";
            } 
            ?>
        </div>
        <div class="newMsg">
            <form action="" method="POST">
                <input type="text" class="writeBox" name="msg">
                <input type="submit" class="submit">
            </form>
        </div>
    </body>

    </html>

    <?php

    if (isset($_POST["msg"]) and $_POST["msg"] != NULL) {
        $msg = $_POST["msg"];

        insertIntoMessageDiscussion($_SESSION["email"], "email2", $msg);

        header("Refresh:0");
    }
}
else {
    header("Location: login.php");
}
    ?>