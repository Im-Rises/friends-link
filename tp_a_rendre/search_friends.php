
<form action="" method="GET">
    <input type="search" name="search" placeholder="Amis à rechercher">
    <input type="submit" value="Rechercher">
</form>

<?php 

session_start();

if(isset($_GET["search"]) and $_GET["search"] != NULL) {
    $array = selectAllMembersWhereNomPrenomEmailWhereSearch($_GET["search"], $_SESSION["email"]);

    foreach($array as $value) {
        $nom = $value['nom'];
        $prenom = $value['prenom'];
        $email = $value['adresse_mail'];
        echo "<a href='messages.php?receiver=$email'>$nom $prenom $email</a>";
    }
}

?>