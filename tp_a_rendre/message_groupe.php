<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Groupe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="friends_link.svg" />
    <?php
    $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>
    <script src="refresh_groups.js"></script>
</head>

<body>
    <?php
    session_start();
    require "dao.php";
    include "ban.php";

    $sender = $_SESSION["email"];
    $idGroupe = $_GET["id"];
    $_SESSION["idGroupe"] = $_GET["id"];

    $groupe = selectGroupeWhereId($idGroupe);
    $groupe = mysqli_fetch_array($groupe);

    $nomGroupe = $groupe["nom"];

    $admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);


    echo "
        <div class='show_name_img_grp'>
            <h1>$nomGroupe</h1><img src='". recupImageGroupe($idGroupe) ."' class='pdp' alt='image de $nomGroupe'>
        </div>";


    if (isAdmin($admins, $sender)) {
        echo "<a href='group_settings.php'>Group Settings</a>";
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
                <div class='containImg'><img src='" . recupImageEmail($_SESSION['email']) . "' class='pdp' alt='$nomSender'>
                </div>
            </div>";
            } else {
                echo "
            <div class='youSend'>
                <div class='containImg'><img src='" . recupImageEmail($membreSender['adresse_mail']) . "' class='pdp' alt='$nomSender'>
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
        <form method="POST">
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
