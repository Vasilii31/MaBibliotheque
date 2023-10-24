<?php

    function Get_User($db, $username)
    {
        $sReq = $db->prepare("SELECT * FROM users WHERE UserName = ?");
        $sReq->execute([$username]);
        return $sReq->fetch();
    }

    function Get_Code_Admin($db)
    {
        $sReq = $db->prepare("SELECT * FROM codeadmin");
        $sReq->execute([]);
        return $sReq->fetch();
    }

    function Modify_Book($db, $id, $nom, $auteur, $genre, $fichier)
    {
        if($fichier!= "")
        {
            $sql = "UPDATE livres SET Nom = ?, Auteur = ?, IdGenre = ?, coverName = ? WHERE IdLivre = ?";
            $dbh = $db->prepare($sql);
            $dbh->execute(
            [
                $nom,
                $auteur,
                $genre,
                $fichier,
                $id
                
            ]);
        }
        else{
            $sql = "UPDATE livres SET Nom = ?, Auteur = ?, IdGenre = ? WHERE IdLivre = ?";
            $dbh = $db->prepare($sql);
            $dbh->execute(
            [
                $nom,
                $auteur,
                $genre,
                $id
                
            ]);
        }
    }

    function delete_Book($db, $id)
    {
        $sql = "DELETE FROM livres WHERE IdLivre=?";
        $stmt= $db->prepare($sql);
        return($stmt->execute([$id]));
    }

    function get_genres($db)
    {
        $sReq = "select * FROM genres";
        $res = $db->query($sReq)->fetchAll();
        return $res;
    }

    function get_All_Books($db)
    {
        $sReq = "SELECT * FROM livres AS l INNER JOIN genres AS g ON l.IdGenre = g.IdGenre";
        $res = $db->query($sReq)->fetchAll();
        return $res;
    }

    function Get_One_Book($db, $id)
    {
        $sReq = $db->prepare("SELECT * FROM livres AS l INNER JOIN Genres AS g ON l.IdGenre = g.IdGenre WHERE IdLivre = ?");
        $sReq->execute([$id]);
        return $sReq->fetch();
    }

    function Get_Books_By_Search_Genre($db, $recherche)
    {
        $dbh = $db->prepare("SELECT * FROM livres AS l INNER JOIN genres AS g ON l.IdGenre = g.IdGenre WHERE g.NomGenre LIKE CONCAT( '%',?,'%')");
        $dbh->execute([$recherche]);
        return $dbh->fetchAll();
    }

    function Get_Books_By_Search_Else($db, $cible, $recherche)
    {
        $dbh = $db->prepare("SELECT * FROM livres WHERE ? LIKE CONCAT( '%',?,'%')");
        $dbh->execute([$cible, $recherche]);
        return $dbh->fetchAll();
    }

    function Genre_Add($db, $genre)
    {
        $sql = "INSERT INTO genres (NomGenre) VALUES (?)";
        $dbh = $db->prepare($sql);
        $dbh->execute(
        [
            $genre          
        ]);
    }

    function book_Add($db, $nom, $auteur, $genre, $dateLu, $cover)
    {
        $res = false;

        if($dateLu == "")
        {
            if($cover != "")
            {
                $sql = "INSERT INTO livres (Nom, Auteur, IdGenre, coverName) 
                VALUES (?, ?, ?, ?)";
                $dbh = $db->prepare($sql);
                $res = $dbh->execute(
                [
                    $nom,
                    $auteur,
                    $genre,
                    $cover
                    
                ]);
            }
            else{
                $sql = "INSERT INTO livres (Nom, Auteur, IdGenre) 
                VALUES (?, ?, ?)";
                $dbh = $db->prepare($sql);
                $res = $dbh->execute(
                [
                    $nom,
                    $auteur,
                    $genre,
                    
                ]);
            }
        }
        else{

            $sql = "INSERT INTO livres (Nom, Auteur, IdGenre, Lu) 
            VALUES (?, ?, ?, ?)";
            $dbh = $db->prepare($sql);
            $res = $dbh->execute(
            [
                $nom,
                $auteur,
                $genre,
                $dateLu
            ]);
        }    

        return $res;
    }

    function get_All_Books_from_User($db, $id)
    {
        $dbh = $db->prepare("SELECT * FROM livres as l inner join livresuser as lu on l.IdLivre = lu.IdLivre where lu.IdUser = ?");
        $dbh->execute([$id]);
        return $dbh->fetchAll();
    }

    function CreateUser($db, $username, $hmdp)
    {
        /*$idListe = CreateListe($db);
        if($idListe == false)
            return $idListe;*/
        $sReq = "INSERT INTO users (UserName, Hmdp) VALUES (?, ?)";
        $dbh = $db->prepare($sReq);
        if($dbh->execute([
            $username,
            $hmdp
        ]) == false)
            return false;
        return true;
    }

function CreateLivreUser($db, $idLivre, $idUser)
{
    $sReq = "INSERT INTO livresuser (IdLivre, IdUser) VALUES (?, ?)";
        $dbh = $db->prepare($sReq);
        if($dbh->execute([
            $idLivre,
            $idUser
        ]) == false)
            return false;
        return true;
}

function Add_Book_to_UserListe($db, $idUser)
{
    $idLivre = $db->lastInsertId();
    $res = ($idLivre > 0) ? true : false;
    if($idLivre > 0)
    {
        $res = CreateLivreUser($db, $idLivre, $idUser);
    }
    return $res;
}

function UpgradeUser($db, $id)
{
    $sql = "UPDATE users SET isAdmin = 1 WHERE IdUser = ?";
            $dbh = $db->prepare($sql);
            $dbh->execute(
            [
                $id              
            ]);
}

function  Get_User_Book($db, $idlivre, $idUser)
{
    $dbh = $db->prepare("SELECT * FROM livresuser  where IdUser = ? and IdLivre = ?");
    $dbh->execute([
        $idUser,
        $idlivre]);
    return $dbh->fetchAll();
}

function  Delete_User_Book($db, $idlivre, $idUser)
{
    $dbh = $db->prepare("DELETE FROM livresuser  where IdUser = ? and IdLivre = ?");
    return($dbh->execute([
        $idUser,
        $idlivre]));
}

function  Delete_All_Users_Book($db, $idlivre)
{
    $dbh = $db->prepare("DELETE FROM livresuser  where IdLivre = ?");
    return($dbh->execute([$idlivre]));
}

