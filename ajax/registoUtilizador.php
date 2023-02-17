<?php
session_start();
include_once('../includes/connection.php');


$email = $_POST['email'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$idade = $_POST['idade'];
$palavraPasse = $_POST['palavraPasse'];



$sql = 'INSERT INTO utilizadores (email, nome, sobrenome, idade, palavraPasse) VALUES
(:email, :nome, :sobrenome, :idade, :palavraPasse);';


    $sth = $dbh->prepare($sql);
    $sth->bindParam('email', $email);
    $sth->bindParam('nome', $nome);
    $sth->bindParam('sobrenome', $sobrenome);
    $sth->bindParam('idade', $idade);
    $sth->bindParam('palavraPasse', $palavraPasse);

    if (
        empty($email) || empty($nome) || empty($sobrenome) || empty($idade) || empty($palavraPasse) 
    ) {
        header('Location:../registarUser.php?error=dadosIncorretos');
        exit;
    }

    $sth->execute();

        


header('Location:../loginUser.php'); 
$sth = null;

die();
?>