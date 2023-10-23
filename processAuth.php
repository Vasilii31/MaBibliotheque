<?php
    require('crud.php');
    require('dbConnect.php');
    require('utils.php');


    $db = connect();
    init_php_session();

    if(isset($_POST) && isset($_POST['valid']))
    {
        if($_POST['valid'] == "Inscription")
        {
            $user = Get_User($db, $_POST['f_username']);
            if($user != false)
            {
                header("location: auth.php?SignSuccess=SignUpKOIdTaken");
                exit;
            }
            else
            {
                $hmdp = password_hash($_POST['f_password'], PASSWORD_BCRYPT);
                $res = CreateUser($db, $_POST['f_username'], $hmdp);
                if($res == false)
                {
                    header("location: auth.php?SignSuccess=SignUpKO");
                    exit;
                }
                else
                {
                    //$res = CreateListeUser($db);
                    header("location: auth.php?SignSuccess=SignUpOK");
                    exit;
                }
            }
            
        }
        elseif($_POST['valid'] == "Connexion")
        {
            $user = Get_User($db, $_POST['f_username']);
            if($user == false)
            {
                header("location: auth.php?SignSuccess=SignInKO");
                exit;
            }
            else
            {
                if(password_verify($_POST['f_password'], $user["Hmdp"]))
                {
                    
                    
                    $_SESSION['UserName'] = $_POST['f_username'];
                    $_SESSION['IdUser'] = $user['IdUser'];
                    $_SESSION['admin'] = $user['IsAdmin'];
                    header("location: index.php");
                }
                else
                {
                    header("location: auth.php?SignSuccess=SignInKO");
                    exit;
                }
            }
        }
        elseif($_POST['valid'] == "Authentification")
        {
            $hashCode = Get_Code_Admin($db);
            if(password_verify($_POST['f_password'], $hashCode['codeAdmin']))
            {
                UpgradeUser($db, $_SESSION["IdUser"]);
                $_SESSION["admin"] = 1;
                header("Location: DisplayAndRedirect.php?result=USERUPGRADEOK");
            }
            else
                header("Location: DisplayAndRedirect.php?result=USERUPGRADEKO");

        }
        
    }
    else
            header("location: auth.php?SignSuccess=SignUpKO");
    

