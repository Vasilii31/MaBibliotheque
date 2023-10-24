<?php

    require('crud.php');
    require('dbConnect.php');
    require("utils.php");

    init_php_session();
    if(!is_admin())
        header("Location: auth.php");

    $db = connect();
    $genres = get_genres($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AddGenre.css"/>
    <script src="AddGenre.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div class="redirect_container">
        <div id="SelectAction">
            <div class="btnAction" id="btnAdd">Ajouter un nouveau genre</div>
            <div class="btnAction" id="btnModify">Modifier un genre</div>
        </div>
        <form id="ModifyGenreForm" class="hidden" action="">
            <select id="genres" name="Genre" required>
                <option value="">Selectionnez un genre</option>
                    <?php
                        if(count($genres) > 0)
                        foreach($genres as $row)
                        {
                            echo '<option value="'.$row["IdGenre"].'">'.$row["NomGenre"].'</option>';
                        }
                
                    ?>
            </select>
            <input id="inputModify" class="hidden" type="text" required>
            <input id="submitModify" class="hidden" type="submit" value="Ajouter">
        </form>
        <form id="AddForm" class="hidden" action="ProcessGenres.php">
            <select id="genresExistants" name="Genre">
                <option value="">Genres Existants :</option>
                    <?php
                        if(count($genres) > 0)
                        foreach($genres as $row)
                        {
                            echo '<option value="'.$row["IdGenre"].'">'.$row["NomGenre"].'</option>';
                        }
                
                    ?>
            </select>
            <input type="text" placeholder="Nom du Genre" required>
            <input type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>