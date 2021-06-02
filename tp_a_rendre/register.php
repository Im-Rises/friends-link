<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <?php
    $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>
</head>

<?php
session_start();
require "dao.php";
include "ban.php"; ?>

<body>
    <main>
        <article>
            <form method="post" class="formRegister">
                <div class="compte">
                    <h3>Créer un compte:</h3>
                    <div class="row">
                        <input type="text" name="nom" placeholder="Nom" required autofocus>
                        <input type="text" name="prenom" placeholder="Prenom" required>
                    </div>
                    <div class="row">
                        <input type="text" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <input type="date" name="bday" required>
                </div>
                <input type="submit" value="Envoyer" class="inscrire">
            </form>
        </article>
    </main>
</body>

</html>
<?php
//Cette condition permet de savoir si une session est déjà ouverte sur ce nivagateur
if (isset($_SESSION["login"])) {
    header("Location: ./accueil.php");
}

//Cette condition permet de savoir si le formulaire a été soumis
if (
    isset($_POST["nom"], $_POST["prenom"], $_POST["bday"], $_POST["email"], $_POST["password"])
    and $_POST["nom"] != NULL and $_POST["prenom"] != NULL and $_POST["email"] != NULL
    and $_POST["password"] != NULL and $_POST["bday"] != NULL
) {
    $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

    if (preg_match($pattern, $_POST["email"]) == 1) {

        $res = insertIntoMembre($_POST["email"], $_POST["nom"], $_POST["prenom"], $_POST["bday"], $_POST["password"]);
        if ($res) {
            session_start();

            $_SESSION["email"] = $_POST["email"];

            header('Location: ./index.php');
        }
    } else {
        echo "<script type='text/javascript'>window.alert('veuillez mettre une adresse mail valide');</script>";
    }
}

?>