<?php
    function Import_Bg($url)
    {
        if($url == null)
        {
            echo "<div id='imgCover'><p>Pas d'image pour ce livre</p></div>";
        }
        else
        {
            echo '<div id="imgCover" style="background:url(./bookCovers/'.$url.');background-size: contain;
            background-repeat: no-repeat;background-position: center;"></div>';
        }
    }

    function Fiche_Infos_Livre($livre)
    {
        if($livre != null)
        {
            echo "<h2>".$livre['Nom']."</h2>";
            echo "<h2>".$livre['Auteur']."</h2>";
            echo "<h2>".$livre['NomGenre']."</h2>";
        }
    }

    function Display_Shelves($library, $nbBooks, $nbShelves)
    {
        if(count($library) > 0)
        {
            for($i = 0; $i < $nbShelves; $i++)
            {
                echo    '<div class="container">
                            <div class="cuboid">
                                <div class="cuboid__face cuboid__face--bottom"></div>
                                <div class="cuboid__face cuboid__face--front"></div>
                                <div class="cuboid__face cuboid__face--back"></div>
                            </div>
                        </div>
                        <div class="books-container">';
                DisplayMyBooks($library, $nbBooks, $i * $nbBooks);
                echo    '</div><div class="floor-thickness"></div>';
            }
        }
    }

    function SearchBy($db, $cible, $recherche)
    {
        switch($cible){
            case "Genre":
                $library = Get_Books_By_Search_Genre($db, $recherche);
                break;
            default:
                $library = Get_Books_By_Search_Else($db, $cible, $recherche);
                break;
        }

        return $library;
    }

    function DisplayMyBooks($library, $nbBooks, $start)
    {
        
        $limit = $nbBooks + $start;
        if($nbBooks + $start >= count($library))
        {
            $limit = count($library);
        }
        for($i = $start; $i < $limit; $i++)
        {
            echo    "<a href='ficheLivre.php?id=".$library[$i]['IdLivre']."'> 
                        <div class='book' style='background: linear-gradient(to right, rgb(60, 13, 20) 3px, 
                        rgba(255, 255, 255, 0.5) 5px, rgba(255, 255, 255, 0.25) 7px, 
                        rgba(255, 255, 255, 0.25) 10px, transparent 12px, 
                        transparent 16px, rgba(255, 255, 255, 0.25) 17px,
                         transparent 22px),
                          url(./bookCovers/".$library[$i]['coverName'].");background-size: contain;
                          background-repeat: no-repeat;background-position: right;background-color:brown;'>
                        </div></a> ";
        }
    }

    function Calc_Nb_Shelves($nbBooks, $nb_book_per_shelf)
    {
        if(($nbBooks % $nb_book_per_shelf) != 0)
        {
            return (intdiv($nbBooks, $nb_book_per_shelf)) + 1;
        } 
        else
            return intdiv($nbBooks, $nb_book_per_shelf);
    }