<?php
    require('crud.php');
    require('dbConnect.php');
    require('display.php');
    require('utils.php');

    init_php_session();
    var_dump($_SESSION);
    if(!is_logged())
        header("Location: auth.php");
    $db = connect();
    /*if(isAdmin())
        $library = get_All_Books($db);
    else*/
    $library = get_All_Books_from_User($db, $_SESSION['IdUser']);
    //var_dump($library);
    //nombre de livre par étagere : 6 à définir en 
    //fonction du viewport ?
    //$nb_Book_per_Shelf = Determine_NbBooks_per_Shelf();
    $nb_Book_per_Shelf = 6;
    //selon le nombre de livre dans la bdd, on détermine combien 
    //d'étageres seront nécessaires pour display tout les livres
    $nbShelves = Calc_Nb_Shelves(count($library), $nb_Book_per_Shelf);

    var_dump($library);
    var_dump((count($library) == 0));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma bibliothèque</title>
    <link rel="stylesheet" href="library.css" />
    <script src="functionsLibrary.js"></script>
</head>
<body>
    <script>var myBooks = <?php echo json_encode($library);?>;</script>
    <div id="header">
        <a href="index.php">
            <h1>Ma bibliothèque</h1>
        </a>
        <div class="dropdown">
            <button onclick="DropDownAjouter()" class="dropbtn">Ajouter</button>
            <div id="DropDownAjouter" class="dropdown-content">
            <div class="dropdown-side">
                <button onclick="DropDownAjouterLivre()" class="dropbtn-side">Ajouter un livre</button>
                <div id="DropDownAjouterLivre" class="dropdown-content-side">
                    <div id="formAjoutLivre">
                            <form action="/add.php?idadd=livre" method="POST" enctype="multipart/form-data">
                                <input type="text" name="Nom" placeholder="Nom" required>
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
                                <input type="date" name="lu">
                                <input type="file" name="fichier">
                                <input type="submit" value="Ajouter">
                                
                            </form>
                            <button onclick="Cancel()">Annuler</button>
                        </div> 
                    </div>
            </div>
            <div class="dropdown-side">
                <button onclick="DropDownAjouterGenre()" class="dropbtn-side">Ajouter un Genre</button>
                <div id="DropDownAjouterGenre" class="dropdown-content-side">
                    <div id="formAjoutLivre">
                            <form action='/add.php?idadd=genre' method="POST" enctype="multipart/form-data">
                                <input type="text" name="genre" placeholder="Genre à ajouter" required>
                                <input type="submit" value="Ajouter">                                
                            </form>
                            <button onclick="Cancel()">Annuler</button>
                        </div> 
                    </div>
            </div>
                    <a href="#">Ajouter un éditeur</a>
                </div>
        </div>
        <div id="Auth">
            <div><a href="auth.php?action=logout">Deconnexion</a></div>
            <div>Creer un Compte</div>
        </div>    
    </div>                              
    <div id="searchBar">
        <input type="text" id="search" name="recherche" placeholder="Votre recherche" />
        <select name="searchBy" id="searchBySelector">
            <option value="">Rechercher Par</option>
            <option value="Genre">Genre</option>
            <option value="Lu">Lu</option>
            <option value="Nom">Nom</option>
            <option value="Auteur">Auteur</option>
        </select>
        <input id="RequestSearch" type="image" src="src/iconSearch.svg" />
        <input id="CancelSearch" type="image" src="src/redCross.svg" />
    </div>
    
    <?php 
        if () 
        {
            
        }
        else 
        {
            Display_Shelves($library, $nb_Book_per_Shelf, $nbShelves);
        }
    ?>
    <div class="scrollable" id="sD">
        <div id="shelf">
            <div class="container">
                <div class="cuboid">
                    <div class="cuboid__face cuboid__face--bottom"></div>
                    <div class="cuboid__face cuboid__face--front"></div>
                    <div class="cuboid__face cuboid__face--back"></div>
                </div>
            </div>
            <div class="books-container"> 
            </div>
            <div class="floor-thickness"></div>
        </div> 
    </div>
    
</body>
</html>