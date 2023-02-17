<?php
session_start();

unset($_SESSION['email']);
unset($_SESSION['logged']);

session_destroy();

$_SESSION = null;

header('Location:../index.php');

die();
?>