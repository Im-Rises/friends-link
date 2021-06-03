<div class="search_friends">
    <form method="GET" class="formSearch">
        <input type="search" name="search" placeholder="Personne à rechercher" class="searchBar">
        <input type="submit" value="Search" class="searchBtn">
    </form>
</div>

<h1>résultat de la recherche (cliquez sur le profil pour l'ajouter)</h1>
<table style="width:100%;text-align:center;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                    </tr>
                </thead>

<?php
//Vérification de la recherche de données de recherche d'un membre via la méthode get
if (isset($_GET["search"]) and $_GET["search"] != NULL) {

    //récupération dans la base de données des personnes correspondant à la recherche
    $array = selectAllMembersWhereNomPrenomEmailWhereSearch($_GET["search"], $_SESSION["email"]);

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

        ?>
            </table>

        <?php
    }
        ?>



        <?php
        if (isset($_GET['recherchePersonne'],) && $_GET['recherchePersonne'] != NULL) {

            $recherchePersonne = $_GET['recherchePersonne'];
            $utilisateur = $_SESSION["email"];

            if ($utilisateur != $recherchePersonne) {
                insertIntoAmiDemandeAmi($utilisateur, $recherchePersonne);
            }
            header("Location: friendsRequest.php");
        }
        ?>