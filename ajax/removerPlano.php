<?php
session_start();
include_once('../includes/connection.php');


$id = $_POST['id'];
$visivel = 0;


$sql = 'UPDATE plano SET visivel=:visivel WHERE id=:id';

$sth = $dbh->prepare($sql);
$sth->bindParam('id', $id);
$sth->bindParam('visivel', $visivel);

    $sth->execute();
    header('Location:../index.php');
    $sth = null;    
?>
                