<!DOCTYPE HTML>
<html>

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="register.css">
</head>

<?php include "ban.php"; ?>

<body>
    <main>
        <article>
            <form method="post" class="formRegister">
                <div class="compte">
                    <h3>Créer un compte:</h3>
                    <center>
                        <div class="row">
                            <input type="text" name="nom" placeholder="Nom" require autofocus>
                            <input type="text" name="prenom" placeholder="Prenom" require autofocus>
                        </div>
                        <div class="row">
                            <input type="email" name="email" placeholder="Email" require autofocus>
                            <input type="password" name="password" placeholder="Mot de passe" require autofocus>
                        </div>
                        <input type="date" name="bday" require autofocus>
                    </center>
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

    $res = insertIntoMembre($_POST["email"], $_POST["nom"], $_POST["prenom"], $_POST["bday"], $_POST["password"]);
    if ($res) {
        session_start();

        $_SESSION["email"] = $_POST["email"];

        header('Location: ./index.php');
    } else echo "remplissez les champs convenablement";
}

?>