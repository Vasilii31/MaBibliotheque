<?php
    require('../Librairies/crud.php');
    require('../Librairies/dbConnect.php');
    require('../Librairies/utils.php');

    $db = connect();

    init_php_session();
    if(!is_logged())
    {
         header("Location: ../auth.php");
         exit;
    }
       

    if(isset($_GET['idadd']))
    {
        header("location: ../index.php");
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
    var_dump($_POST);
    if(isset($_POST['Nom']) && isset($_POST['Auteur']) && isset($_POST['Genre']) && isset($_POST['lu']))
    {
        $uploadName = "";
        if($_FILES["fichier"]["name"] != "")
        {       
            $uploaddir = '../bookCovers/';
            $filename = FileName_format($_POST['Nom']);
            $uploadName = File_exists_verif($filename, $uploaddir, $_FILES["fichier"]["name"]);
            $uploadfile = $uploaddir.$uploadName;   

            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }
        }

        $res = book_Add($db, $_POST['Nom'], $_POST['Auteur'], $_POST['Genre'], $_POST['lu'], $uploadName);
        if($res == true)
        {
            $res = Add_Book_to_UserListe($db, $_SESSION['IdUser']);
            if($res == true)
                header("Location: ../DisplayAndRedirect.php?result=BOOKADDEDOK");
            else
                header("Location: ../DisplayAndRedirect.php?result=BOOKADDEDKO");
        }
        else
            header("Location: ../DisplayAndRedirect.php?result=KO");
        exit;
    }
}    