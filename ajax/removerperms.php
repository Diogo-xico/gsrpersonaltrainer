<?php
session_start();
include_once('../includes/connection.php');


$id = $_POST['id'];
$permissao = 0;


$sql = 'UPDATE utilizadores SET permissao=:permissao WHERE id=:id';

$sth = $dbh->prepare($sql);
$sth->bindParam('id', $id);
$sth->bindParam('permissao', $permissao);

    $sth->execute();
    header('Location:../index.php');
    $sth = null;    
?>