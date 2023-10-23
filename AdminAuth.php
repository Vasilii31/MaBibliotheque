<?php
    /*$pass = "monmdp";
    $hash = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 10]);
    echo $hash;
    echo "<br>";
    echo password_verify($pass, $hash);
    exit;*/

    require('crud.php');
    require('dbConnect.php');
    require('utils.php');
    init_php_session();
    
    if(!is_logged())
        header("Location: auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/auth.css"/>

    <title>Authentification Administrateur</title>
</head>
<body>
    <h1 class="title">Authentification Administrateur</h1>
    <div class="content">
        <div class="formAuth">
        <h1 id="authTitle"  class="title">Veuillez saisir le code Administrateur</h1>
            <form class="formAuthForm" action="processAuth.php" method="post">
                <input  class="inputfields" type="password" id="mdp" name="f_password" placeholder="Code Administrateur">
                <!--<p>Afficher le mot de passe :</p><button type="button" onclick="show_PasswordC()">O</button>-->
                <input class="submitButton" type="submit" name="valid" value="Authentification">
            </form>
        </div>
    </div>
    <!--<script src="/auth.js"></script>-->
</body>
</html>