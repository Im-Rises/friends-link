<?php
	//Ici on créer une nouvelle instance de la classe PDO qui nous permettra de manipuler la BDD plus facilement
        $bdd = new PDO('mysql:host=localhost;dbname=friendsLink;charset=utf8', 'root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>