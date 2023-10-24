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