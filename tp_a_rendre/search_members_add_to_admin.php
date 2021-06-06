<div class="search_friends">
    <form method="GET" class="formSearch">
        <input type="search" name="search" placeholder="Personne à rechercher" class="searchBar">
        <input type="submit" value="Search" class="searchBtn">
    </form>


    <?php

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
        $array = selectMembresNotInAdminWhereIdGroupe($_GET["search"], $_SESSION["idGroupe"]);
    ?>

        <?php
        $row = 0;

        foreach ($array as $value) {
            $row = 0;
            $rowTemp = $row % 2;
            if (!$row) {
        ?>

    <?php
                //Affichage des données des personnes trouvées correspondant à la recherche depuis la base de données
                $nom = $value['nom'];
                $prenom = $value['prenom'];
                $email = $value['adresse_mail'];

                echo "
                    <tr>
                        <td><a href='?recherchePersonne=$email'><img src='" . recupImageEmail($value['adresse_mail']) . "' class='pdp' alt='$email'></a></td>
                        <td><a href='?recherchePersonne=$email'>$nom</a></td>
                        <td><a href='?recherchePersonne=$email'>$prenom</a></td>
                        <td><a href='?recherchePersonne=$email'>$email</a></td>
                    </tr>";
                $row++;
            }
        }
        echo "</table>";
        echo "</div>";
    }
    ?>
</div>

<?php
if (isset($_GET['recherchePersonne'],) && $_GET['recherchePersonne'] != NULL) {

    $recherchePersonne = $_GET['recherchePersonne'];
    $utilisateur = $_SESSION["email"];

    insertIntoAdmin($_SESSION["idGroupe"], $recherchePersonne);
}
?>