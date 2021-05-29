<!DOCTYPE HTML>
<html>

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
</head>
<?php include "ban.php";?>

<body>
    <form method="post" method="" class="formLogin">
        <div class="login">
            <h1>Se Connecter</h1>
            <center>
                <input type="email" name="mail" placeholder="Email" required autofocus>
                <input type="password" name="password" placeholder="Mot de passe" required autofocus>
            </center>
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

    if (password_verify($_POST['password'], $membre["mdp"])) {
        session_destroy();
        session_start();
        $_SESSION["email"] = $membre["adresse_mail"];
        header("Location: index.php");
    } else {
        echo 'Le mot de passe est invalide! Veuillez réesayer';
    }
}
?>
    