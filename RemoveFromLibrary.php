<?php

require('crud.php');
require('dbConnect.php');
require("utils.php");

init_php_session();

if(!is_logged())
        header("Location: auth.php");

if(isset($_GET['id']) && intval($_GET['id']) > 0)
{
    $db = connect();
    $res = Get_User_Book($db, $_GET['id'], $_SESSION["IdUser"]);
    if(count($res) != 0)
    {
        $res = Delete_User_Book($db, $_GET['id'], $_SESSION['IdUser']);
        if($res == true)
            header("Location: DisplayAndRedirect.php?result=BOOKREMOVEDOK");
        else 
            header("Location: DisplayAndRedirect.php?result=KO");
    }
    else
    {
        header("Location: DisplayAndRedirect.php?result=KO");
    }
    
}   