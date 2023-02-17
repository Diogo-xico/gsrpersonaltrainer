<?php
session_start();

$email = $_POST['emailLogin'];
$password = $_POST['passwordLogin'];


require('connection.php');
$sql = 'SELECT id, email FROM utilizadores WHERE email LIKE :e AND palavraPasse LIKE :p';
$sth = $dbh->prepare($sql);
$sth->bindParam(':e', $email);
$sth->bindParam(':p', $password);
$sth->execute();

$obj = $sth->fetchObject();

if ($sth && $sth->rowCount() == 1) {
    $_SESSION['email'] = $email;
    $_SESSION['logged'] = 1;
    $_SESSION['id'] = $obj->id;
    header('Location:../index.php');

} else {
    $_SESSION['logged'] = 0;
    $_SESSION['email'] = $email;
    header('Location:../loginUser.php');
}

?>