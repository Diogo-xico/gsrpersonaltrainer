<?php
session_start();
include_once('../includes/connection.php');

$session = session_id();
$idProduto = $_POST['idProduto'];
$precoProduto = $_POST['precoProduto'];
$nomeProduto = $_POST['nomeProduto'];
$quantidadeProduto = $_POST['quantidadeProduto'];
$tamanhoProduto = $_POST['tamanhoProduto'];


$artigo = [
    'idproduto' => $idProduto,
    'precoproduto' => $precoProduto,
    'nomeproduto' => $nomeProduto,
    'quantidadeproduto' => $quantidadeProduto,
    'tamanhoproduto' => $tamanhoProduto,
];

$_SESSION['carrinho'][] = $artigo;

header('Location:../loja.php');
exit;

?>
