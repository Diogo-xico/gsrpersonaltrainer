<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="body-artigo">
    <?php include_once('includes/connection.php') ?>
    <?php include_once('ajax/guardarVariaveis.php') ?>
    <header>
        <?php include_once('includes/menu.php') ?>
    </header>
    <main>
        <div id="main-content">
        
        <?php

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 1;


        $sql = 'SELECT * FROM produtos 
            WHERE  id = :id';

        $sth = $dbh->prepare($sql);
        $sth->bindParam('id', $id);
        $sth->execute();
        ?>

        <?php
        $artigo = $sth->fetchObject();
        ?>
        
        <!--Selecão do artigo a mostrar-->
        <div class="container">
            <div class="row pb-4">
                <?php if(($artigo -> categoria) === 1) { ?>
                    <div class="display-4 text-center mt-5 pt-5"><?= $artigo->nome?></div>
                    <div class="col-12 col-lg-6 my-2 pt-2 ">
                        <img class="img-fluid rounded artigos camisola " src="imagens/<?= $artigo->imagem?>" alt="<?= $artigo->nome?>">
                    </div>
                    <div class="col-12 col-lg-6 text-center text-lg-start my-2 pt-2">
                        <div class="fs-5 mt-3 mb-4" id="preço">
                            Preço: <?= $artigo->preco ?> €
                        </div>
                        <div class="fs-5 mt-2 mb-4" id="descricao">
                            Descrição: <?= $artigo->descricao ?>
                        </div>
                        
                        <form action="ajax/adicionaCarrinho.php" method="POST"> 
                            <input type="hidden" value="<?= $artigo->id ?>" name="idProduto">
                            <input type="hidden" value="<?= $artigo->preco ?>" name="precoProduto">
                            <input type="hidden" value="<?= $artigo->nome ?>" name="nomeProduto">
                            <span class="fs-5">Tamanho: </span>
                            <select name="tamanhoProduto" class="form-control w-25 my-2 border-1">
                                <option style="background: #efefef;" value="xs">XS</option>
                                <option style="background: #efefef;" value="s">S</option>
                                <option style="background: #efefef;" value="m">M</option>
                                <option style="background: #efefef;" value="l">L</option>
                                <option style="background: #efefef;" value="xl">XL</option>
                                <option style="background: #efefef;" value="xxl">XXL</option>
                            </select>
                            <span class="fs-5">Quantidade:</span>
                            <input type="number" value="1" name="quantidadeProduto" min="1" class="btn border-0 m-2 w-25" style="background: #efefef">        
                            <p><button type="submit" class="btn-artigo-selec fs-5 border-0 my-2">
                                    Adicionar <i class="bi bi-cart"></i>
                            </button></p>
                        </form>
                    </div>
                    <?php } else { ?>
                        <div class="display-4 text-center mt-5 pt-5"><?= $artigo->nome?></div>
                    <div class="col-12 col-lg-6 my-2 pt-2 ">
                        <img class="img-fluid rounded artigos" src="imagens/<?= $artigo->imagem?>" alt="<?= $artigo->nome?>">
                    </div>
                    <div class="col-12 col-lg-6 text-center text-lg-start my-2 pt-2">
                        <div class="fs-5 mt-3 mb-4" id="preço">
                            Preço: <?= $artigo->preco ?> €
                        </div>
                        <div class="fs-5 mt-2 mb-4" id="descricao">
                            Descrição: <?= $artigo->descricao ?>
                        </div>
                        
                        <form action="ajax/adicionaCarrinho.php" method="POST"> 
                            <input type="hidden" value="<?= $artigo->id ?>" name="idProduto">
                            <input type="hidden" value="<?= $artigo->preco ?>" name="precoProduto">
                            <input type="hidden" value="<?= $artigo->nome ?>" name="nomeProduto">
                            <span class="fs-5">Cor: </span>
                            <?php if(($artigo -> nome) == "Garrafa de Vidro quokka") { ?>
                                <select name="tamanhoProduto" class="form-control w-25 my-2 border-1">
                                    <option style="background: #efefef;" value="vermelho">Vermelho</option>
                                    <option style="background: #efefef;" value="rosa">Rosa</option>
                                    <option style="background: #efefef;" value="branco">Branco</option>
                                </select>
                                <?php } else { ?>
                                <select name="tamanhoProduto" class="form-control w-25 my-2 border-1">
                                    <option style="background: #efefef;" value="rosa">Rosa</option>
                                    <option style="background: #efefef;" value="verde">Verde</option>
                                    <option style="background: #efefef;" value="laranja">Laranja</option>
                                </select>
                                <?php } ?>
                            <span class="fs-5">Quantidade:</span>
                            <input type="number" value="1" name="quantidadeProduto" min="1" class="btn border-0 m-2 w-25" style="background: #efefef">        
                            <p><button type="submit" class="btn-artigo-selec fs-5 border-0 my-2">
                                    Adicionar <i class="bi bi-cart"></i>
                            </button></p>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>        
    </div>  
    
    <footer>
        <?php include_once('includes/footer.php'); ?>
    </footer>
        
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/website.js"></script>

</body>
</html>