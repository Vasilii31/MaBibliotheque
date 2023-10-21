<?php

    function Get_User($db, $username)
    {
        $sReq = $db->prepare("SELECT * FROM users WHERE UserName = ?");
        $sReq->execute([$username]);
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
        $stmt->execute([$id]);
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
    
        if($dateLu == "")
        {
            if($cover != "")
            {
                $sql = "INSERT INTO livres (Nom, Auteur, IdGenre, coverName) 
                VALUES (?, ?, ?, ?)";
                $dbh = $db->prepare($sql);
                $dbh->execute(
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
                $dbh->execute(
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
            $dbh->execute(
            [
                $nom,
                $auteur,
                $genre,
                $dateLu
            ]);
        }     
    }

    function get_All_Books_from_User($db, $id)
    {
        $dbh = $db->prepare("SELECT * from livres as l 
                    INNER join collectionlivre as cl on l.IdLivre = cl.IdLivre 
                    INNER JOIN userliste as ul on ul.IdCollectionLivre = cl.IdCollectionLivre
                    INNER JOIN users as u on u.idListe = ul.IdListe
                    WHERE u.IdUser = ?");
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



