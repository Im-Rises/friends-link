session_start();

//Cette condition permet de savoir si une session est déjà ouverte sur ce nivagateur
if(!isset($_SESSION["login"])){
    header("Location: ./login.php"); 
}
//Si l'utilisateur n'est pas déjà connecté on le redirige sur la page login