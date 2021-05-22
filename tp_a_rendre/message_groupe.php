<!DOCTYPE html>
<html>

<head>
    <title>Groupe</title>
    <link rel="stylesheet" href="style.css">
</head>

<script src="script.js"></script>

<?php
require "ban.php";

?>

<body>
    <?php

    $sender = $_SESSION["email"];
    $idGroupe = $_GET["id"];
    $_SESSION["idGroupe"] = $_GET["id"];

    $groupe = selectGroupeWhereId($idGroupe);
    $groupe = mysqli_fetch_array($groupe);
    
    $admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);

    if(isAdmin($admins, $sender)) {
        echo "<a href='group_settings.php'>Group Settings</a>";
    }
    echo "<br/>".recupImageGroupe($idGroupe);

    $dateTemp = "";
    $messages = selectAllMessagesFromGroupeWhereId($idGroupe);
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
                ".recupImageEmail($_SESSION['email'])."
                $prenomSender $nomSender : $msg 
            </div>";
        } else {
            echo "
            <div class='youSend'>
            ".recupImageEmail($membreSender['adresse_mail'])."
            $prenomSender $nomSender : $msg 
            </div>";
        }
    }
    ?>
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

    insertIntoMessageGroupe($sender, $idGroupe, $msg);
    header("Refresh:0");
}
?>
</body>

</html>