<?php
session_start();
include('../includes/connection.php');

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho']) && isset($_SESSION['id']) && $clientId = $_SESSION['id']) {
    $precoTotal = 0;
    foreach ($_SESSION['carrinho'] as $artigo) {
        $precoTotal += $artigo['precoproduto'] * $artigo['quantidadeproduto'];
        $idProduto = $artigo['idproduto'];
        $precoProduto = $artigo['precoproduto'];
        $nomeProduto = $artigo['nomeproduto'];
        $quantidadeProduto = $artigo['quantidadeproduto'];
        $tamanhoProduto = $artigo['tamanhoproduto'];
    }

    $numeroEncomenda = "ENC" . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $dataEncomenda = date("Y-m-d H:i:s");

    $query = $dbh->prepare("SELECT nome, sobrenome, email, id FROM utilizadores WHERE id = ?");
    $query->execute([$clientId]);
    $result = $query->fetch();
    $nome = $result['nome'];
    $sobrenome = $result['sobrenome'];
    $email = $result['email'];
    $clientId = $result['id'];


    foreach ($_SESSION['carrinho'] as $artigo) {


        foreach ($_SESSION['carrinho'] as $artigo) {

            $idProduto = $artigo['idproduto'];
            $precoProduto = $artigo['precoproduto'];
            $nomeProduto = $artigo['nomeproduto'];
            $quantidadeProduto = $artigo['quantidadeproduto'];
            $tamanhoProduto = $artigo['tamanhoproduto'];

            $sql = 'INSERT INTO encomenda (quantidadeProduto, tamanhoProduto, dataEncomenda, precoEncomenda,
                    numeroEncomenda, idproduto, precoProduto, nomeProduto, nome, sobrenome, email, idcliente) VALUES(:quantidadeProduto, :tamanhoProduto, :dataEncomenda, :precoEncomenda,
                    :numeroEncomenda, :idproduto, :precoProduto,:nomeProduto, :nome, :sobrenome, :email, :idcliente);';

            $sth = $dbh->prepare($sql);
            $sth->bindParam('quantidadeProduto', $quantidadeProduto);
            $sth->bindParam('tamanhoProduto', $tamanhoProduto);
            $sth->bindParam('dataEncomenda', $dataEncomenda);
            $sth->bindParam('precoEncomenda', $precoTotal);
            $sth->bindParam('numeroEncomenda', $numeroEncomenda);
            $sth->bindParam('idproduto', $idProduto);
            $sth->bindParam('precoProduto', $precoProduto);
            $sth->bindParam('nomeProduto', $nomeProduto);
            $sth->bindParam('nome', $nome);
            $sth->bindParam('sobrenome', $sobrenome);
            $sth->bindParam('email', $email);
            $sth->bindParam('idcliente', $clientId);

            $sth->execute();
        }

        unset($_SESSION['carrinho']);
        header('Location:../loja.php');
        $sth = null;

        die();



    }
}
?>