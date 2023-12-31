<?php

    require("./Librairies/utils.php");

    init_php_session();
    if(!is_logged())
        header("Location: auth.php");

    if(isset($_GET))
    {
        // var_dump($_GET);

        switch($_GET["result"])
        {
            case "BOOKDELETEDOK":
                $output = "Le livre a été supprimé de la base de données et celle des utilisateurs.";
                $href = "index.php";
                break;
            case "GENREMODIFYOK":
                $output = "Le genre a bien été modifié.";
                $href = "index.php";
                break;
            case "GENREMODIFYKO":
                $output = "Une erreur est survenue lors de l'ajout du nouveau genre.";
                $href = "AddGenre.php";
                break;
            case "GENREADDEDOK":
                $output = "Le nouveau genre a bien été ajouté à la base de données.";
                $href = "index.php";
                break;
            case "GENREADDEDKO":
                $output = "Une erreur est survenue lors de l'ajout du nouveau genre.";
                $href = "AddGenre.php";
                break;
            case "BOOKREMOVEDOK":
                $output = "Le livre a été retiré de votre bibliothèque!";
                $href = "index.php";
                break;
            case "BOOKEXIST":
                $output = "Ce livre existe déjà dans votre bibliothèque !";
                $href = "index.php";
                break;
            case "BOOKADDEDOK":
                $output = "Livre ajouté avec succès à votre bibliothèque !";
                $href = "index.php";
                break;
            case "BOOKADDEDKO":
                $output = "Une erreur est survenue : Le livre n'a pas pu être ajouté. Veuillez réessayer plus tard.";
                $href = "index.php";
                break;
            case "USERUPGRADEOK":
                $output = "Elevation Administrateur effectuée.";
                $href = "index.php";
                break;
            case "USERUPGRADEKO":
                $output = "Code Administrateur incorrect.";
                $href = "AdminAuth.php";
                break;
            default:
                $output = "Une erreur est survenue. Veuillez réessayer plus tard.";
                $href = "index.php";
                break;                
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DisplayAndRedirect.css"/>
    <title>Document</title>
</head>
<body>
    <div class="redirect_container">
        <p><?php echo $output;?></p>
        <button class="button"><a href=<?php echo $href;?> id="retour">Retour</a></button>
    </div>
</body>
</html>