<?php
    require('crud.php');
    require('dbConnect.php');
    require('utils.php');

    var_dump($_POST);

    $db = connect();
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
                    
                    init_php_session();
                    $_SESSION['UserName'] = $_POST['f_username'];
                    $_SESSION['IdUser'] = $user['IdUser'];
                    header("location: index.php");
                }
                else
                {
                    header("location: auth.php?SignSuccess=SignInKO");
                    exit;
                }
            }
        }
        
    }
    else
            header("location: auth.php?SignSuccess=SignUpKO");
    

