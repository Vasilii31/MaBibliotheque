<?php
    require('../Librairies/crud.php');
    require('../Librairies/dbConnect.php');
    require("../Librairies/utils.php");

    init_php_session();
    if(!is_admin())
    {
        header("Location: ../auth.php");
        exit;
    }

    $db = connect();

    if(isset($_POST))
    {
        if(isset($_POST["method"]))
        {
            if($_POST["method"] == "Ajouter")
            {
                $res = Genre_Add($db, $_POST["nom"]);
                if($res == true)
                    header("Location: ../DisplayAndRedirect.php?result=GENREADDEDOK");
                else
                    header("Location: ../DisplayAndRedirect.php?result=GENREADDEDKO");
                
            }
            elseif($_POST["method"] == "Modifier")
            {
                if(isset($_POST["nom"]) && $_POST["nom"] != "" && isset($_POST["Genre"]) && intval($_POST["Genre"]) > 0)
                {
                    $res = Modify_Genre($db, $_POST["Genre"], $_POST["nom"]);
                    if($res == true)
                        header("Location: ../DisplayAndRedirect.php?result=GENREMODIFYOK");
                    else
                        header("Location: ../DisplayAndRedirect.php?result=GENREMODIFYKO");
                }
                
            }
        }
    }