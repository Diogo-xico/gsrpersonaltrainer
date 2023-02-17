<?php
include('../includes/connection.php');
session_start();
$idProduto = $_POST['idProduto'];

foreach ($_SESSION['carrinho'] as $posicao => $carrinho) {
    if ($carrinho['idproduto'] == $idProduto) {
        unset($_SESSION['carrinho'][$posicao]);
        ?>
        <script>
            window.history.back();
        </script>
        <?php
        break;
    }
}