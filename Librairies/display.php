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
            echo "<div class='infoLivre'>".$livre['Nom']."</div>";
            echo "<div class='infoLivre'>".$livre['Auteur']."</div>";
            echo "<div class='infoLivre'>".$livre['NomGenre']."</div>";
        }
    }

    function Display_Shelves($library, $nbBooks, $nbShelves, $add)
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
                DisplayMyBooks($library, $nbBooks, $i * $nbBooks, $add);
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

    function DisplayMyBooks($library, $nbBooks, $start, $add)
    {
        
        $limit = $nbBooks + $start;
        if($nbBooks + $start >= count($library))
        {
            $limit = count($library);
        }
        for($i = $start; $i < $limit; $i++)
        {
            echo    "<a href='ficheLivre.php?id=".$library[$i]['IdLivre']."&add=".$add."'> 
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