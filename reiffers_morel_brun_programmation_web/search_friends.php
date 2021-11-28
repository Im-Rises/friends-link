<div class="search_friends">
    <form method="GET" class="formSearch">
        <input type="search" name="search" placeholder="Amis à rechercher" class="searchBar">
        <input type="submit" value="Search" class="searchBtn">
    </form>
</div>
<?php
//Vérification de la recherche de données de recherche d'un ami via la méthode get
if (isset($_GET["search"]) and $_GET["search"] != NULL) {
    echo "<div class='allTab'>
            <h1>résultat de la recherche (cliquez sur le profil pour l'ajouter)</h1>
        <table style='width:100%;text-align:center;'>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                            </tr>
                        </thead>";
    //récupération dans la base de données des personnes correspondant à la recherche
    $array = selectAllMembersWhereNomPrenomEmailWhereSearch($_GET["search"], $_SESSION["email"]);

    foreach ($array as $value) {
        $row = 0;
        $rowTemp = $row % 2;
        if (!$row) {
?>
            <?php
            $nom = $value['nom'];
            $prenom = $value['prenom'];
            $email = $value['adresse_mail'];

            echo "
                        <tr>
                            <td><a href='messages.php?receiver=$email'><img src='" . recupImageEmail($email) . "' class='pdp' alt='image de profil'></a></td>
                            <td><a href='messages.php?receiver=$email'>$nom</a></td>
                            <td><a href='messages.php?receiver=$email'>$prenom</a></td>
                            <td><a href='messages.php?receiver=$email'>$email</a></td>
                        </tr>";
            $row++;
            ?>
        <?php
        }
        ?>

<?php
        //Affichage des données des personnes trouvées correspondant à la recherche depuis la base de données

    }
    echo "    </table>

        </div>";
}

?>