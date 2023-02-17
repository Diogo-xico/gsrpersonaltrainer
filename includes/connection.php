<?php
$user = 'web';
$pass = 'web';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=gsrpersonaltrainer;charset=utf8', $user, $pass);
} catch (PDOException $e) {
    print 'Error ' . $e->getMessage() . '<br>';
}


?>