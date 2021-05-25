<?php
session_start();
require "dao.php";

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="ban.css">
</head>
<header>
    <a href="index.php" class="titleBan"><img src="friends_link.svg"></a>
    <nav role="navigation">

        <div class="menuInLine">
            <a href="index.php">Accueil</a>
            <?php
            if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
                $membre = selectMembreWhereEmail($_SESSION["email"]);
                $membre = mysqli_fetch_array($membre);

                $nom = $membre["nom"];
                $prenom = $membre["prenom"];

                echo "
                        <a href='mon_profil.php' class='monProfil'>"
                            .recupImageEmail($_SESSION["email"]). "$nom $prenom
                        </a>
                        <a href='show_all_discussions.php'>
                            Messaging
                        </a>
                        <a href='friendsRequest.php'>
                            Friends Request
                        </a>
                        <a href='destroy_session.php'>
                            Disconnect
                        </a>";
            } else {
                echo "
                        <a href='login.php'>
                            Login
                        </a>
                        <a href='register.php'>
                            Register
                        </a>";
            }
            ?>

            <a href="#">A propos</a>
        </div>

        <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>

            <ul id="menu">
                <a href="index.php">
                    <li>Home</li>
                </a>


                <?php
                if (isset($_SESSION["email"]) and $_SESSION["email"] != NULL) {
                    $membre = selectMembreWhereEmail($_SESSION["email"]);
                    $membre = mysqli_fetch_array($membre);

                    $nom = $membre["nom"];
                    $prenom = $membre["prenom"];

                    echo "
                        <a href='mon_profil.php'>
                            <li>$nom $prenom</li>
                        </a>
                        <a href='show_all_discussions.php'>
                            <li>Messaging</li>
                        </a>
                        <a href='friendsRequest.php'>
                            <li>Friends Request</li>
                        </a>
                        <a href='destroy_session.php'>
                            <li>Disconnect</li>
                        </a>";
                } else {
                    echo "
                        <a href='login.php'>
                            <li>Login</li>
                        </a>
                        <a href='register.php'>
                            <li>Register</li>
                        </a>";
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

</html>