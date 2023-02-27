<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<style>


    .footer-produto {
        position: fixed;
        bottom: 0;
        width: 100%; 
    }


</style>

<body id="body-artigo">
    <?php include_once('includes/connection.php') ?>
    <?php include_once('ajax/guardarVariaveis.php')?>
    <header>
        <?php include_once('includes/menu.php') ?>
    </header>

    <main>
        <?php
        if (isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = '1';

        $sql = 'SELECT * FROM produtos WHERE  id = :id';

        $sth = $dbh->prepare($sql);
        $sth->bindParam('id', $id);
        $sth->execute();

        $artigo = $sth->fetchObject();
        ?>

        <div class="container sproduct my-5 pt-5">
            <div class="row mt-5">

                <div class="col-12 col-sm-12 col-md-6 col-lg-4 d-flex align-items-center mx-auto">
                    <img class="img-fluid w-100 rounded artigos" src="imagens/produtos/<?= $artigo->imagem ?>"
                        alt="<?= $artigo->nome ?>">
                </div>
                <div class="col-12 col-sm-12 col-md-6 mx-auto">
                    <h6 class="mt-4">
                        <a href="loja.php" style="text-decoration: none; color: #212529;">
                            Loja </a>/ <?= $artigo->nome ?>
                    </h6>
                    <h3 class="py-4">
                        <?= $artigo->nome ?>
                    </h3>
                    <h2>
                        <?= $artigo->preco ?> €
                    </h2>
                    <h4 class="my-4">Detalhes do produto</h4>
                    <span>
                        <?= $artigo->descricao ?>
                    </span>

                    <form action="ajax/adicionaCarrinho.php" method="POST">
                        <input type="hidden" value="<?= $artigo->id ?>" name="idProduto">
                        <input type="hidden" value="<?= $artigo->preco ?>" name="precoProduto">
                        <input type="hidden" value="<?= $artigo->nome ?>" name="nomeProduto">
                        <?php if (($artigo->categoria) === 1) { ?>
                            <h6 class="mt-3 mb-1">Tamanho:</h6>
                            <select name="tamanhoProduto" class="form-control w-50 mb-3 border-1 text-center"
                            style="background: #efefef;">
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                                <option value="xxl">XXL</option>
                            </select>
                        <?php } else {
                            if (($artigo->nome) == "Garrafa de Vidro quokka") { ?>
                                <h6 class="mt-3 mb-1">Cor:</h6>
                                <select name="tamanhoProduto" class="form-control w-50 my-2 border-1 text-center">
                                    <option style="background: #efefef;" value="vermelho">Vermelho</option>
                                    <option style="background: #efefef;" value="rosa">Rosa</option>
                                    <option style="background: #efefef;" value="branco">Branco</option>
                                </select>
                            <?php } elseif (($artigo->nome) == "Garrafa de Metal quokka") { ?>
                                <h6 class="mt-3 mb-1">Cor:</h6>
                                <select name="tamanhoProduto" class="form-control w-50 my-2 border-1 text-center">
                                    <option style="background: #efefef;" value="rosa">Rosa</option>
                                    <option style="background: #efefef;" value="azul">Azul</option>
                                    <option style="background: #efefef;" value="laranja">Laranja</option>
                                </select>
                            <?php } elseif (($artigo->nome) == "Garrafa Prateada quokka") { ?>
                                <h6 class="mt-3 mb-1">Cor:</h6>
                                <select name="tamanhoProduto" class="form-control w-50 my-2 border-1 text-center">
                                    <option style="background: #efefef;" value="prata">Prata</option>
                                </select>
                            <?php } else { ?>
                                <h6 class="mt-3 mb-1">Cor:</h6>
                                <select name="tamanhoProduto" class="form-control w-50 my-2 border-1 text-center">
                                    <option style="background: #efefef;" value="marmore">Mármore</option>
                                </select>
                            <?php }
                        } ?>
                        <h6 class="mt-3 mb-1">Quantidade:</h6>
                        <input type="number" value="1" name="quantidadeProduto" min="1" class="btn border-0 my-2 w-50"
                            style="background: #efefef">
                        <div>
                            <button type="submit" class="btn-artigo-selec border-0 my-3 w-50">
                                Adicionar <i class="bi bi-cart"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer-produto">
        <?php include_once('includes/footer.php'); ?>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/website.js"></script>

</body>

</html>