<?php

    require('crud.php');
    require('dbConnect.php');
    require("utils.php");

    init_php_session();
    if(!is_admin())
    {
        header("Location: auth.php");
        exit;
    }
        

    if(isset($_GET['id']) && intval($_GET['id']) > 0)
    {
        $db = connect();
        $b = Get_One_Book($db, $_GET['id']);
        if($b != false)
        {
            if($b["coverName"] != null)
            {
                $path = './bookCovers/'.$b["coverName"];
                var_dump($path);
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
            $res1 = delete_Book($db, $_GET['id']);
            $res2 = Delete_All_Users_Book($db, $_GET['id']);
            if($res1 && $res2)
            {
                header("Location: DisplayAndRedirect.php?result=BOOKDELETEDOK");
            }
            else
                header("Location: DisplayAndRedirect.php?result=KO");
            }
            else{
                header("Location: DisplayAndRedirect.php?result=KO");
        }
    
        
    }