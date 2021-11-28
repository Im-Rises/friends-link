<?php
session_start();

if (isset($_SESSION["email"], $_GET["id_post"], $_GET["page"]) and $_SESSION["email"] != NULL and $_GET["id_post"] != NULL and $_GET["page"] != NULL) {
    require "dao.php";
    $page = $_GET["page"];

    insertIntoLikes($_GET["id_post"], $_SESSION["email"]);

    if (!isset($_GET["profil"]) and $_GET["profil"] == NULL) header("Location: $page");
    else {
        $profil = $_GET["profil"];
        echo "$page?email=$profil";
        header("Location: $page?email=$profil");
    }
} else {
    $page = $_GET["page"];

    if (!isset($_GET["profil"]) and $_GET["profil"] == NULL) header("Location: $page");
    else {
        $profil = $_GET["profil"];
        echo "$page?email=$profil";
        header("Location: $page?email=$profil");
    }
}
