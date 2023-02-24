<?php session_start(); 

    if (isset($_SESSION['id']))
        $clientId = $_SESSION['id'];

        $sql = 'SELECT * FROM utilizadores WHERE id = :id ';

        $sth = $dbh->prepare($sql);
        $sth->bindParam('id', $clientId);
        $sth->execute();
    
        $inf = $sth->fetchObject();
    
        
?>