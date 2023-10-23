<?php
    if(isset($_GET))
    {
        // var_dump($_GET);

        switch($_GET["result"])
        {
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
                $href = "index.php";
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
    <div class="display">
        <p><?php echo $output;?></p>
        <button><a href=<?php echo $href;?> id="retour">Retour</a></button>
    </div>
</body>
</html>