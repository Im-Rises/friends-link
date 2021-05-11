<?php

// ici on se connecte à la base de données
$serveur     = "localhost";
$utilisateur = "root";
$mdp         = "";
$db          = "qdc_livre";
$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $db);

function insertIntoLivre($titre, $auteur, $date) {
    // pour utiliser des variables instanciées en dehors de la fonction 
    global $connexion; 

    // on protege nos variables d'insertions de script => voir faille XSS
    $titre = htmlspecialchars($_POST["titre"]);
    $auteur = htmlspecialchars($_POST["auteur"]);
    $date = htmlspecialchars($_POST["date"]);


    $req = "INSERT INTO livre(titre, auteur, date_creation) VALUES ('$titre', '$auteur', '$date');";

    // on fait la requete d'insertion
    return mysqli_query($connexion, $req);
}

function selectAllFromLivre() {
    global $connexion;
    $req = "SELECT * FROM livre;";
    return mysqli_query($connexion, $req);
}

function deleteFromId($id) {
    global $connexion;
    $req = "DELETE FROM livre WHERE id='$id';";
    return mysqli_query($connexion, $req);
}

function selectFromLivreWhereId($id) {
    global $connexion;
    $req = "SELECT * FROM livre WHERE id='$id';";
    return mysqli_query($connexion, $req);
}

function updateFromLivreWhereId($id, $titre, $date, $auteur) {
    global $connexion;

    $titre = htmlspecialchars($_POST["titre"]);
    $date = htmlspecialchars($_POST["date_creation"]);
    $auteur = htmlspecialchars($_POST["auteur"]);

    $req = "UPDATE livre SET titre='$titre', auteur='$auteur', date_creation='$date' WHERE id='$id';";
    return mysqli_query($connexion, $req);
}

?>