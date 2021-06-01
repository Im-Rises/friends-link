<?php
session_start();

if (isset($_SESSION["email"], $_GET["id_post"]) and $_SESSION["email"] != NULL and $_GET["id_post"] != NULL) {
    require "dao.php";

    deleteLikeWhereEmailAndIdPost($_GET["id_post"], $_SESSION["email"]);

    header("Location: index.php");
} else {
    echo $_SESSION['email']  . " " . $_GET['id_post'];
    header("Location: index.php");
}
