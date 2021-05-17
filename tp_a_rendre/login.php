<?php
session_start();

//Cette condition permet de savoir si une session est déjà ouverte sur ce nivagateur
if(isset($_SESSION["login"])){
    header("Location: ./accueil.php"); 
}
//Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil

/*On met le bout de code qui sert à se connecter à la bdd dans un fichier à part 
(Pour éviter d'avoir à le retaper à chaque fois)*/
require_once('scripts/bdd.php');

//Cette condition permet de savoir si le formulaire a été soumis
if(isset($_POST["toto"])){

    /*Rappel : On manipule la bdd avec les méthodes de la classe PDO.
    Pour comprendre : https://www.php.net/manual/fr/pdo.prepare.php*/

    $mail = $_POST['mail'];
    
    //On prépare la requête pour éviter les injections. Pour comprendre: https://www.journaldunet.fr/web-tech/developpement/1202885-comment-eviter-une-injection-sql-en-php/#:~:text=Pour%20pr%C3%A9venir%20les%20injections%20SQL,code%20SQL%20dans%20des%20champs.
    $req = $bdd->prepare("SELECT  `id`, `email`, `password`
    FROM  `user`
    WHERE `email` = '$mail'");

    // Ici on éxécute la requête préparée ci-dessus
    $req->execute();

    // Ici on stocke le résultat de la requête dans un tableau
    $reponse = $req->fetch();

    /* Cette condition permet de décrypter le mot de passe et de vérifier si il correspond.
     Pour comprendre: https://www.php.net/manual/fr/function.password-verify.php */
    if (password_verify($_POST['password'], $reponse[2])) {
        $_SESSION['login'] = $reponse[0];
        header("Location: ./accueil.php");
    } else {
	echo 'Le mot de passe est invalide! Veuillez réesayer';
    }

    
}
?>

<!DOCTYPE HTML>
<html>
	<head>  
		<title>FriendsLink</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    
    <body>

        <header>
            <nav>
		<!--Plus tard mettre une navbar.-->
            </nav>
        </header>  

        <main>
            <article style="margin:10px 50px 0px;">
                <div style="padding: 20px 20px 30px; margin: 20px 0px 30px; width: 25rem;  background: #e7e7e7;">
                <h3>Connexion:</h3>
                <form method="post">
                    <div>
                        <label for="inputEmail3">Mail:</label>
                        <input type="mail" name="mail" placeholder="Email">
                    </div>
                    <div>
                        <label for="form">Mot de passe:</label>
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>
                    <input type="submit" value="Envoyer" style="margin: 30px 5px 0px;">
                    
                </form>
                
            </div>
            </article>
        </main>
	</body>

</html>