<?php
    require('./Librairies/crud.php');
    require('./Librairies/dbConnect.php');
    require('./Librairies/display.php');
    require('./Librairies/utils.php');

    init_php_session();

    if(!is_logged())
        header("Location: auth.php");
    $db = connect();
    if(isset($_GET['add']) && $_GET['add'] == true)
        $library = get_All_Books_Notyet_Added($db, $_SESSION['IdUser']);
    else
        $library = get_All_Books_from_User($db, $_SESSION['IdUser']);
    //var_dump($library);
    //nombre de livre par étagere : 6 à définir en 
    //fonction du viewport ?
    //$nb_Book_per_Shelf = Determine_NbBooks_per_Shelf();
    $nb_Book_per_Shelf = 6;
    //selon le nombre de livre dans la bdd, on détermine combien 
    //d'étageres seront nécessaires pour display tout les livres
    $nbShelves = Calc_Nb_Shelves(count($library), $nb_Book_per_Shelf);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma bibliothèque</title>
    <link rel="stylesheet" href="library.css" />
    <script src="javascript/functionsLibrary.js"></script>
</head>
<body>
    <script>
        var myBooks = <?php echo json_encode($library);?>;
        var add = "false";
        <?php if(isset($_GET['add']) && $_GET['add'] == "true") :?>
            var add = <?php echo json_encode($_GET['add']); ?>;
        <?php endif; ?>
        //var add = <?php// echo json_encode()?>
    </script>
    <?php require("header.php");?>  
    <?php if(isset($_GET['add']) && $_GET['add'] == "true") : ?> 
        <div id="AddDisplay">
            <p>Ici vous sont proposés tout les livres de notre base de données. Vous pouvez cliquer dessus pour 
                les ajouter à votre bibliothèque personnelle. Si le livre que vous cherchez n'existe pas, vous pouvez en ajouter un nouveau ici:
            </p>
            <form action="BackEnd/add.php?idadd=livre" method="POST" enctype="multipart/form-data">
                <input  type="text" name="Nom" placeholder="Nom" required>
                <input type="text" name="Auteur" placeholder="Auteur" required>
                <select id="genres" name="Genre">
                    <?php
                        $genres = get_genres($db);
                        if(!isset($genres) || $genres == null)
                        {
                            echo "OUPS";
                        }
                        foreach($genres as $row)
                        {
                            echo '<option value="'.$row["IdGenre"].'">'.$row["NomGenre"].'</option>';
                        }
                
                    ?>
                </select>
                <input type="date" name="lu">
                <input type="file" name="fichier">
                <input type="submit" value="Ajouter">
            </form>
        </div>
    <?php endif; ?>
    <div <?php if(!isset($_GET['add']) || $_GET['add'] != "true"){echo 'style="padding-top: 70px;"';} /*if(!isset($_GET['add']) && count($library) == 0){var_dump("COUCOU"); echo 'style="display: none;"';}*/?>  id="searchBar">
        <input class="searchBarItem" type="text" id="search" name="recherche" placeholder="Votre recherche" />
        <select class="searchBarItem" name="searchBy" id="searchBySelector">
            <option value="">Rechercher Par</option>
            <option value="Genre">Genre</option>
            <option value="Lu">Lu</option>
            <option value="Nom">Nom</option>
            <option value="Auteur">Auteur</option>
        </select>
        <input class="searchBarItem" id="RequestSearch" type="image" src="src/iconSearch.svg" />
        <input class="searchBarItem" id="CancelSearch" type="image" src="src/redCross.svg" />
    </div>
    <?php if(!isset($_GET['add']) && count($library) == 0) : ?>
            <div id="NoBook">
                <p>Vous n'avez encore aucun livre dans votre bibliothèque !</p>
                <a class="aButton" href='index.php?add=true'>Ajouter un nouveau livre</a>
            </div>
    <?php endif;?>    
    <?php if(count($library) > 0) : ?>  
    <div class="scrollable" id="sD">
        <div id="shelf">
            <div class="container">
                <div class="cuboid">
                    <div class="cuboid__face cuboid__face--bottom"></div>
                    <div class="cuboid__face cuboid__face--front"></div>
                    <div class="cuboid__face cuboid__face--back"></div>
                </div>
            </div>
            <div class="books-container"></div>
            <div class="floor-thickness"></div>
        </div> 
    </div>  
    <?php endif;?>

</body>
</html>