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
                <h3>Connexion:</h3>
                <form method="post">
                    <input type="mail" name="mail" placeholder="Email">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" value="Envoyer" style="margin: 30px 5px 0px;">
                </form>

            </div>
        </article>
    </main>
</body>

</html>
<?php
session_start();

require "dao.php";

if (isset($_POST["mail"], $_POST["password"]) and $_POST["password"] != NULL and $_POST["mail"] != NULL) {

    $mail = htmlspecialchars($_POST['mail']);

    $membre = selectDataMembersWhereEmail($mail);

    $membre = mysqli_fetch_array($membre);

    if (password_verify($_POST['password'], $membre["mdp"])) {
        $_SESSION["email"] = $membre["adresse_mail"];
        echo "c'est bon !";
    } else {
        echo 'Le mot de passe est invalide! Veuillez réesayer';
    }
}
?>