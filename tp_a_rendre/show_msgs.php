
<?php require "dao.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php 
        $discussions = selectMessagesDiscussion("email1", "email2");
        foreach($discussions as $value) {
            $emailSender = $value["email_envoyeur"];
            $emailReceiver = $value["email_receveur"];
            $msg = $value["message_text"];
            $date = $value["date_envoie"];

            echo "$emailSender to $emailReceiver, $date : $msg <br>";

        }
    ?>

</body>

</html>