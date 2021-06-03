<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <?php
    $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>
</head>
<?php
session_start();
include "dao.php";
?>

<body>
    <?php
    include "ban.php";
    ?>
    <form method="post" class="formLogin">
        <div class="login">
            <h1>Se Connecter</h1>
            <input type="email" name="mail" placeholder="Email" required autofocus>
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <input type="submit" value="Se connecter" class="seConnecter">
    </form>
</body>

</html>
<?php

if (isset($_POST["mail"], $_POST["password"]) and $_POST["password"] != NULL and $_POST["mail"] != NULL) {

    $mail = htmlspecialchars($_POST['mail']);
    $membre = selectDataMembersWhereEmail($mail);
    $membre = mysqli_fetch_array($membre);

    if ($membre != NULL) {

        if (password_verify($_POST['password'], $membre["mdp"])) {
            session_destroy();
            session_start();
            $_SESSION["email"] = $membre["adresse_mail"];
            header("Location: index.php");
        } else {
            echo "<script type='text/javascript'>window.alert('mot de passe invalide');</script>";
        }
    } else {
        echo "<script type='text/javascript'>window.alert('compte inexistant');</script>";
    }
}
?>