<?php

    require('crud.php');
    require('dbConnect.php');

    if(isset($_GET['id']) && $_GET['id'] != null)
    {
        header("location: /index.php");
        $db = connect();

        delete_Book($db, $_GET['id']);

    }
    else{
        var_dump("rien");
    }