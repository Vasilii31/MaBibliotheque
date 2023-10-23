<?php
    require('crud.php');
    require('dbConnect.php');
    require('display.php');

    $db = connect();
    if(isset($_GET['id']))
    {
        $infosLivre = Get_One_Book($db, $_GET['id']);
    }
    
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre</title>
    <link rel="stylesheet" href="library.css" />
    <script src="ficheLivre.js"></script>
</head>
<body>
    <?php include('header.php'); ?>
    <div id="centerBookFiche">
    <div id="BookFiche">
        <?php Import_Bg($infosLivre['coverName']); ?>
        <div id="carrouselModify">
            <div id="infoslivre">
                <?php Fiche_Infos_Livre($infosLivre);?>
            </div>
            <div id="formInfosLivre" class="hidden">
                <form action=<?php if(isset($_GET['id'])){echo "/modifyBook.php?id=".$_GET['id'];}?> method="POST" enctype="multipart/form-data">
                    <input type="text" name="Nom" value="<?php echo $infosLivre['Nom'];?>" required>
                    <input type="text" name="Auteur" value="<?php echo $infosLivre['Auteur'];?>" required>
                    <select id="genres" name="Genre">
                    <?php
                        $genres = get_genres($db);
                        if($genres != null)
                        {     
                            foreach($genres as $row)
                            {
                                echo '<option value="'.$row["IdGenre"].'"';
                                if($infosLivre['IdGenre'] == $row['IdGenre'])
                                {
                                    echo "selected='selected'";
                                }
                                echo 'value="'.$row["IdGenre"].'">'.$row["NomGenre"];
                                echo '</option>';
                            }
                        }
                    ?>
                    <input type="file" name="fichier">
                    <input type="submit" value="Valider">
                </form>
            </div>
        </div>
        <div id="btnsDown">
            <a href="index.php">
            <div id="btnRetour" class="btn">Retour
            </div></a>
            <?php if(isset($_GET['add']) && $_GET['add'] == 1) : ?>
                <a href=<?php echo "AddToLibrary.php?id=".$_GET['id']; ?>>Ajouter à ma bibliothèque</a>
            <?php //elseif( ) : ?>            
            <div id="btnModifier" class="btn">Modifier
            </div>
            <div id="btnSupprimer" class="btn">Supprimer
            </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
</body>
</html>