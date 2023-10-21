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
    
    if(isset($_GET['action']) && $_GET['action'] == "logout")
    {
        clean_php_session();
        header("Location: auth.php");
    }

    $db = connect();
    if(isset($_POST['valid']))
    {
        if($_POST['valid'] == "Connexion")
        {

        }

        if($_POST['valid'] == "Inscription")
        {

        }

        if(isset($_POST['f_username']) && !empty($_POST['f_username']) &&
            isset($_POST['f_password']) && !empty($_POST['f_password']))
        {
            $user = Get_User($db, $_POST['f_username']);
            if($user != null)
            {
                if(password_verify($_POST['f_password'], $user['Hmdp']))
                {
                    init_php_session();

                    $_SESSION['userName'] = $user['UserName'];
                    $_SESSION['userId'] = $user['IdUser'];
                    $_SESSION['isAdmin'] = $user['IsAdmin'];
                    print_r("Mot de passe correct");
                    header('Location: index.php');
                }
                else
                {
                    print_r("Identifiant ou mot de passe incorrect.");
                }
            }
            else{
                print_r("Identifiant ou mot de passe incorrect.");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/auth.css"/>

    <title>Authentification</title>
</head>
<body>
    <h1 class="title">Bienvenue sur mabibliotheque.com !</h1>
    <?php   
            if(isset($_GET["SignSuccess"]))
            {
                switch($_GET["SignSuccess"]) 
                {
                    case "SignUpOK":
                        echo "<p id='success'>Utilisateur créé avec succès. Vous pouvez maintenant vous connecter.</p>";
                        break;
                    case "SignUpKO":
                        echo "<p id='error'>Une erreur est survenue, veuillez réessayer plus tard.</p>";
                        break;
                    case "SignUpKOIdTaken":
                        echo "<p id='error'>Un compte avec cette adresse mail existe déjà.</p>";
                        break;
                    case "SignInKO":
                        echo "<p id='error'>Nom d'utilisateur ou mot de passe incorrect.</p>";
                        break;
                }
            } 
    ?>
    <div class="content">
        <div class="formAuth">
            <h1>Se connecter</h1>
            <form class="formAuthForm" action="processAuth.php" method="post">
                <input  class="inputfields" type="email" name="f_username" placeholder="Adresse Mail">
                <input  class="inputfields" type="password" id="mdp" name="f_password" placeholder="Mot de passe">
                <p>Afficher le mot de passe :</p><button type="button" onclick="show_PasswordC()">O</button>
                <input class="submitButton" type="submit" name="valid" value="Connexion">
            </form>
        </div>
        <div class="formAuth">
            <h1>S'inscrire</h1>
            <form class="formAuthForm" id="formSignUp" action="processAuth.php" method="post">
                <input  class="inputfields" type="email" name="f_username" placeholder="Adresse Mail" required>
                <input  class="inputfields" type="password" id="pwd" name="f_password" placeholder="Mot de passe" required>
                <input class="inputfields" type="password" id="cpwd" name="f_passwordConfirm" placeholder="Confirmation du Mot de passe" required>
                <p id="pwdError" style="display: none">Les mots de passe ne correspondent pas.</p>
                <p>Afficher le mot de passe :</p><button type="button" onclick="show_PasswordI()">O</button>
                <input class="submitButton" id="sbc" type="submit" name="valid" value="Inscription">
            </form>
        </div>
    </div>
    <script src="/auth.js"></script>
</body>
</html>