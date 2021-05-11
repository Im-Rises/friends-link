<?php 
require "dao.php";

if(isset($_GET['id'])) {
    deleteFromId($_GET['id']);
    header('Location: ajout_livre.php');
}

?>