<?php

    function init_php_session() : bool
    {
        if(!session_id())
        {
            session_start();
            session_regenerate_id();
            return true;
        }
        return false;
    }

    function is_logged() : bool
    {
        if(isset($_SESSION['UserName']))
            return true;
        else
            return false;
    }

    function is_admin()
    {
        if(is_logged())
        {
            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                return true;
        }
        return false;
    }

    function clean_php_session() : void 
    {
        session_unset();
        session_destroy();
    }

    function FileName_format($name)
    {
        $name = str_replace(' ', '', $name);
        $name = str_replace("'", "", $name);
        $name = str_replace('"', "", $name);
        $name = str_replace(";", "", $name);

        return $name;
    }

    function File_exists_verif($filename, $location, $extension)
    {

        $tmp = basename($filename.'.'.pathinfo($extension, PATHINFO_EXTENSION));
        $file_absolute_path = $location.$tmp;
        $ind = 0;
        while(file_exists($file_absolute_path))
        {
            $ind++;
            $filename = $filename.strval($ind);
            $tmp = basename($filename.'.'.pathinfo($_FILES["fichier"]["name"], PATHINFO_EXTENSION));
            $file_absolute_path = $location.$tmp;
        }
        return basename($filename.'.'.pathinfo($_FILES["fichier"]["name"], PATHINFO_EXTENSION));
    }