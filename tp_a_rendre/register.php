<!DOCTYPE HTML>
<html>

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    <main>
        <article style="margin:10px 50px 0px;">
            <div style="padding: 20px 20px 30px; margin: 20px 0px 30px; width: 25rem;  background: #e7e7e7;">
                <h3>Créer un compte:</h3>
                <form method="post">
                    <input type="text" name="nom" placeholder="Nom">
                    <input type="text" name="prenom" placeholder="Prenom">
                    <input type="mail" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="date" name="bday">
                    <input type="submit" value="Envoyer" style="margin: 30px 5px 0px;">
                </form>

            </div>
        </article>
    </main>
</body>

</html>
<?php
session_start();
//Cette condition permet de savoir si une session est déjà ouverte sur ce nivagateur
if (isset($_SESSION["login"])) {
    header("Location: ./accueil.php");
}

//Cette condition permet de savoir si le formulaire a été soumis
if (isset($_POST["nom"], $_POST["prenom"], $_POST["bday"], $_POST["email"], $_POST["password"]) 
    and $_POST["nom"] != NULL and $_POST["prenom"] != NULL and $_POST["email"] != NULL 
    and $_POST["password"] != NULL and $_POST["bday"] != NULL) {

    require "dao.php";

    insertIntoMembre($_POST["email"], $_POST["nom"], $_POST["prenom"], $_POST["bday"], $_POST["password"]);

    header('Location: ./login.php');
}

?>