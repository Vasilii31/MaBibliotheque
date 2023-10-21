<?php
    require('crud.php');
    require('dbConnect.php');
    require('utils.php');

    $db = connect();

    if(isset($_GET['idadd']))
    {
        header("location: /index.php");
        switch($_GET['idadd'])
        {
            case 'genre':
                AddGenre($db);
                break;
            case 'livre':
                AddBook($db);
                break;
        }
           
    }


function AddGenre($db)
{
    if(isset($_POST['genre']))
    {
        Genre_Add($db, $_POST['genre']);
    }
}
    
function AddBook($db)
{
    if(isset($_POST['Nom']) && isset($_POST['Auteur']) && isset($_POST['Genre']) && isset($_POST['lu']))
    {
        $uploadName = "";
        if($_FILES["fichier"]["name"] != "")
        {       
            echo "CouCou";
            var_dump($_FILES);
            $uploaddir = './bookCovers/';
            $filename = FileName_format($_POST['Nom']);
            $uploadName = File_exists_verif($filename, $uploaddir, $_FILES["fichier"]["name"]);
            $uploadfile = $uploaddir.$uploadName;   

            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }
        }

        book_Add($db, $_POST['Nom'], $_POST['Auteur'], $_POST['Genre'], $_POST['lu'], $uploadName);
        exit;
    }
}    