<?php
session_start();
//require "dao.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="ban.css">
</head>
<header>
    Friends Link
    <nav role="navigation">
        <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu">
                <a href="index.php">
                    <li>Home</li>
                </a>
                <a href="show_all_discussions.php">
                    <li>Messagerie</li>
                </a>
                <a href="login.php">
                    <li>Login</li>
                </a>
                <a href="register.php">
                    <li>Register</li>
                </a>
                <a href="#">
                    <li>Friends Request</li>
                </a>
            </ul>
        </div>
    </nav>
</header>

</html>