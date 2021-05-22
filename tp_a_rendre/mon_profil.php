<?php
include "ban.php";
if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
    $profil = selectMembreWhereEmail($_SESSION["email"]);
    $profil = mysqli_fetch_array($profil);
    //echo $_SESSION["email"];
    //var_dump($profil);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Mon profil</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php
            echo "<h1>$profil[prenom] $profil[nom]</h1>";      
            
            if (file_exists("images/$profil[adresse_mail]"))
            {
                echo "<a href='addImgServ.php'><img src='images/$profil[adresse_mail]' width='200' height='200'></a>";
            }
            else
            {
                echo "<a href='addImgServ.php'><img src='images/Homer_Simpson.jpg' width='200' height='200'></a>";
            }
            
        ?>

        <p>Adresse mail : <?php echo $profil['adresse_mail'] ?></p>

        <h2>Liste des amis de la personne sur clic</h2>

        <h2>Liste des posts de la personne sur clic</h2>

        <!-- Ici faire l'affichage de tous les posts de la personne -->

    </body>

    </html>



<?php
} else {
    header("Location: login.php");
}
?>