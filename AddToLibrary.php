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
    $res = CreateLivreUser($db, $_GET['id'], $_SESSION['IdUser']);
    if($res == true)
        header("Location: DisplayAndRedirect.php?result=BOOKADDEDOK");
    else 
        header("Location: DisplayAndRedirect.php?result=BOOKADDEDKO");
}   