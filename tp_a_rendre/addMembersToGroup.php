<?php
include "ban.php";

$idGroupe = $_GET["idGroupe"];

$email = $_SESSION["email"];

$admins = selectAdminEmailFromAdminGroupeWhereIdGroupe($idGroupe);
$admins = mysqli_fetch_array($admins);

if (!isAdmin($admins, $email)) {
    header("Location: index.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Group Settings</title>
    </head>

    <body>

        <form action="" method="POST">
            <!-- <input type="text"> -->
        </form>
    </body>

    </html>

<?php

}

?>