<!DOCTYPE HTML>
<html>

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
</head>
<?php include "ban.php"; ?>

<body>
    <main>
        <div class="login">
            <h1>LOGIN</h1>
            <form method="post">
                <input type="email" name="mail" placeholder="Email" required autofocus>
                <input type="password" name="password" placeholder="Mot de passe" required autofocus>
                <input type="submit" value="Envoyer" style="margin: 30px 5px 0px;">
                <a href="register.php">Inscription</a>
            </form>
        </div>
    </main>
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