<div class="search_friends">
    <form method="GET" class="formSearch">
        <input type="search" name="search" placeholder="Amis à rechercher" class="searchBar">
        <input type="submit" value="Search" class="searchBtn">
    </form>

    <?php
    
    //Vérification de la recherche de données de recherche d'un ami via la méthode get
    if (isset($_GET["search"]) and $_GET["search"] != NULL) {

        //récupération dans la base de données des personnes correspondant à la recherche
        $array = selectAllMembersWhereNomPrenomEmailWhereSearch($_GET["search"], $_SESSION["email"]);
        
        foreach ($array as $value) {
            $row = 0;
            $rowTemp = $row % 2;
            if (!$row) {
    ?>
                <h1>résultat de la recherche </h1>
                <div class='showTab'>
                    <div class='divHead'>
                        <div class='headElement'>Image</div>
                        <div class='headElement'>Nom</div>
                        <div class='headElement'>Prenom</div>
                        <div class='headElement'>Email</div>
                    </div>
                </div>
                <?php
            }
                ?>

        <?php
        //Affichage des données des personnes trouvées correspondant à la recherche depuis la base de données
            $nom = $value['nom'];
            $prenom = $value['prenom'];
            $email = $value['adresse_mail'];

            echo "
                <div class='divBody'>
                    <a href='messages.php?receiver=$email'><div class='bodyElement'><img src='".recupImageEmail($email)."' class='pdp' alt='image de profil'></div></a>
                    <a href='messages.php?receiver=$email'><div class='bodyElement'>$nom</div></a>
                    <a href='messages.php?receiver=$email'><div class='bodyElement'>$prenom</div></a>
                    <a href='messages.php?receiver=$email'><div class='bodyElement'>$email</div></a>
                </div>";
            $row++;
        }
    }

        ?>

</div>