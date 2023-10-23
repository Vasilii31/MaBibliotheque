<?php
    require('dbConnect.php');

    $db = connect();
    $code = password_hash("421842", PASSWORD_BCRYPT);

    $sReq = "INSERT INTO codeadmin (codeAdmin) VALUES (?)";
    $dbh = $db->prepare($sReq);
    $dbh->execute([$code]);
