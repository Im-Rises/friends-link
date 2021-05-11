<!DOCTYPE html>
<html>

<head>
    <title>gestion des livres</title>
    <meta charset="utf-8">
</head>

<body>
    <fieldset>
        <legend>A REMPLIR !!!!</legend>
        <!-- 
        post passe par le serveur
        get passe par l'url 
        -->
        <form action="ajout_livre.php" method="POST">
            <input type="text" placeholder="titre du livre" name="titre"> <br>
            <input type="text" placeholder="auteur" name="auteur"> <br>
            <input type="date" name="date"> <br>
            <input type="submit" value="Ajouter"> <br>
        </form>
    </fieldset>
</body>



</html>
