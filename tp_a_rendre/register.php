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
if(isset($_POST["nom"])){ 

    /*Rappel : On manipule la bdd avec les méthodes de la classe PDO.
    Pour comprendre : https://www.php.net/manual/fr/pdo.prepare.php*/

    $requete = $bdd->prepare('INSERT INTO `user`(`nom`, `prenom`, `droit`, `email`, `password`, `id_Ets`) 
    VALUES (:nom,:prenom, :email, :password)');

    /*On ne stock pas les mdp en clair dans la bdd pour cela on utilise:
    https://www.php.net/manual/fr/function.password-hash.php*/
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $requete->execute(array(
        ':nom'=> $_POST["nom"],
        ':prenom'=> $_POST["prenom"],
        ':email'=> $_POST["mail"],
        ':password'=> $password,
    )); 
    $requete->closeCursor();

    //Une fois le compte créé, on redirige vers la page login
    header('Location: ./login.php');
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
                <h3>Créer un compte:</h3>
                <form method="post">
		    <div>
                        <label>Nom:</label>
                        <input type="text" name="nom" placeholder="Nom">
                    </div>
		    <div>
                        <label>Prenom:</label>
                        <input type="text" name="prenom" placeholder="Prenom">
                    </div>
                    <div>
                        <label for="inputEmail3">Mail:</label>
                        <input type="mail" name="email" placeholder="Email">
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