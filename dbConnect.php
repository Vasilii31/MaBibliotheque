<?php
    function connect()
    {
        $db = new PDO('mysql:host=localhost;dbname=bibliothèque;charset=utf8', 'root','', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $db;

    }