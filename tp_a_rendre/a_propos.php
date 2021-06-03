<?php session_start();
include "dao.php";
?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>FriendsLink</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="a_propos.css">
    <link rel="icon" href="friends_link.svg" />
    <?php
    $css = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME) == "index.php" ? "indexBan.css" : "ban.css";
    echo "<link rel='stylesheet' href='$css'>";
    ?>

</head>

<body class="container">
    <?php include "ban.php"; ?>

    <section>
        <div class="friendsLink">
            <h1>Friends Link?</h1>
            <div class="propos">
                <p>
                    Friends Link est un réseau social réalisé en tant que projet final dans le cadre de nos études,
                    à l'ESME sudria. Ce projet a pour but de mettre en avant toutes nos connaissances aqcuises durant nos cours
                    de programmation web
                </p>
                <p>Ce réseau social vous permettra donc:</p>
                <ul>
                    <li><a> d'envoyer des messages à vos amis</a></li>
                    <li><a>de rechercher et d'inviter de nouveaux amis</a></li>
                    <li><a> de partager vos pensées sur le fil d'actualité</a></li>
                </ul>
                <p> De plus, vous allez pouvoir personnaliser votre profil en modifiant votre photo de profil
                    et votre biographie au fil de vos envies. </p>
            </div>

        </div>
        <div class="propos">
            <h1>Qui sommes-nous ?</h1>
            <p> Nous sommes trois jeunes étudiants enthousiastes et motivés pour tout type de projet. Nous sommes en ingé1 (1ère année cycle ingénieur) à l'ESME Sudria Lille.
                Notre équipe se compose donc de Reiffers Clément, Morel Quentin et Brun Dorine.
            </p>

        </div>
    </section>
    <aside>
        <h1>Friends link en bref</h1>
        <table>
            <tr>
                <th>Nom Réseau</th>
                <td>Friends link</td>
            </tr>
            <tr>
                <th>Notre logo</th>
                <td><img src="./images/logos/logo.png" alt="logo"></td>
            </tr>
            <tr>
                <th>Date création</th>
                <td>Mai 2021</td>
            </tr>
            <tr>
                <th>Notre équipe</th>
                <td>Quentin Morel, Reiffers Clément et Brun Dorine</td>
            </tr>
        </table>
    </aside>
</body>

</html>