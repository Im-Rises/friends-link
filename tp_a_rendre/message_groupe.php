<!DOCTYPE html>
<html>

<head>
    <title>Groupe</title>
    <link rel="stylesheet" href="style.css">
</head>

<script src="refresh_groups.js"></script>

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

    $nomGroupe = $groupe["nom"];

    $admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);


    echo "
        <div class='show_name_img_grp'>
            <h1>$nomGroupe</h1>"
        . recupImageGroupe($idGroupe) .
        "</div>";


    if (isAdmin($admins, $sender)) {
        echo "<center><a href='group_settings.php'>Group Settings</a></center>";
    }

    $dateTemp = "";
    $messages = selectAllMessagesFromGroupeWhereId($idGroupe);

    ?>
    <div id="show_msg" class="show_msg">
        <?php
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

    insertIntoMessageGroupe($sender, $idGroupe, $msg);
    header("Refresh:0");
}
?>
</body>

</html>