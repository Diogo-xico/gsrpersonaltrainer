<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    body {
        min-height: 100vh;
        background: linear-gradient(180deg, rgba(189, 152, 113, 0.8186624991793592) 0%, rgba(33, 37, 41, 1) 50%);
    }

    .fixed-top {
        position: static;
    }


    @media (min-width:992px) {

        .fixed-top {
            position: sticky;

        }

        .img {

            max-width: 200px;

        }

    }
</style>

<body>
    <?php include_once('includes/connection.php') ?>

    <?php

    if (isset($_SESSION['id']))
        $clientId = $_SESSION['id'];

    $sql = 'SELECT * FROM utilizadores WHERE id = :id ';

    $sth = $dbh->prepare($sql);
    $sth->bindParam('id', $clientId);
    $sth->execute();

    $inf = $sth->fetchObject();

    ?>

    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>

    <div id="perfil" class="container-fluid mt-5 p-5 reveal text-white ">
        <?php
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) { ?>


            <div class="informacoes row text-center">
                <div class="col-12  col-lg-6 p-3">
                    <div class="titulo-transformacoes pt-5 pb-5 text-center ">Dados de Envio</div>
                    <div class="pb-3 fs-3">Nome:
                        <?= $inf->nome ?>
                        <?= $inf->sobrenome ?>
                    </div>
                    <div class="pb-3 fs-3">Morada:
                        <?= $inf->morada ?>
                    </div>
                    <div class="pb-3 fs-3">Localidade:
                        <?= $inf->localidade ?>
                    </div>
                    <div class="pb-3 fs-3">Código-Postal:
                        <?= $inf->codigoPostal ?>
                    </div>
                    <div class="pb-3 fs-3">Email:
                        <?= $inf->email ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-3">
                    <div class="titulo-transformacoes pt-5 pb-5 text-center ">Resumo</div>

                    <?php

                    $precototal = 0;

                    if (isset($_SESSION['carrinho'])) {
                        foreach ($_SESSION['carrinho'] as $carrinho) {
                            $precototal += $carrinho['precoproduto'] * $carrinho['quantidadeproduto'];
                        }
                    }
                    ?>


                    <?php
                    if (isset($_SESSION['carrinho'])) {
                        foreach ($_SESSION['carrinho'] as $carrinho) {
                            $total = 0;
                            $idProduto = $carrinho['idproduto'];
                            $sth = $dbh->prepare("SELECT * FROM produtos WHERE id= :idproduto");
                            $sth->bindParam(':idproduto', $idProduto);
                            $sth->execute();
                            $artigo = $sth->fetchObject();
                            $total += $carrinho['precoproduto'] * $carrinho['quantidadeproduto'];
                            ?>

                            <div class="d-flex justify-content-between mb-1 fs-4">
                                <div>

                                    <form action="ajax/removerCarrinho.php" method="post">
                                        <input type="hidden" name="idProduto" value="<?= $artigo->id ?>">
                                        <button type="submit" class="btn-close btn-close-white fs-6" aria-label="Close"></button>
                                        <span class="titulo">
                                            <?= $carrinho['nomeproduto'] ?> -->
                                        </span>
                                        <?php if (($artigo->categoria) === 1) { ?>
                                            <span class="fs-6 text-center">
                                                Tamanho:
                                                <?= $carrinho['tamanhoproduto'] ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="fs-6 text-center">
                                                Cor:
                                                <?= $carrinho['tamanhoproduto'] ?>
                                                </dspan>
                                            <?php } ?>
                                            <span class="titulo text-uppercase fs-6">
                                                <?= $carrinho['tamanhoproduto'] ?>
                                            </span>
                                            <span class="info fs-6">
                                                QTD:
                                                <?= $carrinho['quantidadeproduto'] ?>
                                            </span>


                                    </form>


                                </div>


                                <span class="titulo fs-5">
                                    <?= $carrinho['precoproduto'] ?>€
                                </span>
                            </div>


                            <?php


                        }
                    }
                    ?>

                    <div class="d-flex justify-content-between border-top border-white mt-2 mb-2">
                        <div class="titulo fs-4">Total</div>
                        <span class="titulo fs-5">
                            <?= $precototal ?>€
                        </span>
                    </div>
                    <?php


                    if ($precototal != 0) {
                        ?>
                        <div class=" d-flex justify-content-end mt-4">
                            <div class="col-4"></div>
                            <div class="col-4" data-bs-toggle="modal" data-bs-target="#confirmarEncomenda"> <button
                                    class=" btn1">Finalizar Compra</button></div>
                            <div class="col-4"></div>

                        </div>

                        <?php
                    }

                    ?>

                    <div class="modal fade" id="confirmarEncomenda" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Aviso</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-black">
                                    <div> Tem a certeza que pretende finalizar a encomenda?</div>
                                </div>
                                <form action="ajax/encomenda.php">
                                    <div class="modal-footer">
                                        <button type="submit" name="update" class="btn1"
                                            value="update">Finalizar</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            <?php }else { ?>

                <div style=" background: linear-gradient(180deg, rgba(189, 152, 113, 0.8186624991793592) 0%, rgba(33, 37, 41, 1) 50%), min-height: 100vh;">
                    <div class="container pt-5">

                        <div class="row">
                            <div class="col-md-8 text-center mx-auto">
                                <div class=" text-uppercase mt-5 fs-1">Ups, não devias estar aqui.</div>
                                <div class="info fs-5">Para teres acesso a este conteúdo faz Login ou Regista-te
                                    <a href="loginUser.php" class="titulo"> aqui</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

        <?php } ?>
        </div>

    </div>


    <script src="js/bootstrap.bundle.min.js"></script>

</body>



</html>