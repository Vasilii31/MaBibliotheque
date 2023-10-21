<?php

require('crud.php');
require('dbConnect.php');
require('utils.php');

$db = connect();
header("location: /ficheLivre.php?id=".$_GET['id']);
if(isset($_GET['id']) && isset($_POST['Nom']) && isset($_POST['Genre']) && isset($_POST['Auteur']))
{
    $uploadName = "";
    if($_FILES['fichier']['name'] != '')
    {   
        var_dump($_FILES);
        echo "file detected...Uploading...";    
        $uploaddir = './bookCovers/';
        $filename = FileName_format($_POST['Nom']);
        //$uploadName = basename(str_replace(' ', '', $_POST['Nom']).'.'.pathinfo($_FILES["fichier"]["name"], PATHINFO_EXTENSION));
        $uploadName = File_exists_verif($filename, $uploaddir, $_FILES["fichier"]["name"]);
        $uploadfile = $uploaddir.$uploadName;
        var_dump($uploadName);
        
                //tentative de reformatage de l'image
                /*$maxDim = 800;
                $file_name = $_FILES['fichier']['tmp_name'];
                list($width, $height, $type, $attr) = getimagesize( $file_name );
                if ( $width > $maxDim || $height > $maxDim ) {
                    $target_filename = $file_name;
                    $ratio = $width/$height;
                    if( $ratio > 1) {
                        $new_width = $maxDim;
                        $new_height = $maxDim/$ratio;
                    } else {
                        $new_width = $maxDim*$ratio;
                        $new_height = $maxDim;
                    }
                    $src = imagecreatefromstring( file_get_contents( $file_name ) );
                    $dst = imagecreatetruecolor( $new_width, $new_height );
                    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
                    imagedestroy( $src );
                    imagepng( $dst, $target_filename ); // adjust format as needed
                    imagedestroy( $dst );
                }*/    

            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }


    }

    Modify_Book($db, $_GET['id'], $_POST['Nom'], $_POST['Auteur'], $_POST['Genre'], $uploadName);
}