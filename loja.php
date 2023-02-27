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

<body id="body-estilo1">

    <?php include_once('includes/connection.php') ?>
    <?php include_once('ajax/guardarVariaveis.php')?>

    <header>
        <?php include_once('includes/menu.php') ?>
    </header>

    <main>
        <div id="main-content">

            <?php
            $sql = 'SELECT * FROM produtos WHERE visivel = 1 AND categoria = :C';
            $sth = $dbh->prepare($sql);
            echo $sth->rowCount(); //testar se estao a vir os dados da BD
            ?>
            <!-- camisola -->
            <div class="container mt-5 pt-3" id="camisola">
                <div class="display-5 text-center text-white">Camisolas</div>
                <div class="row">

                    <?php
                    $sth->bindValue(':C', 1);
                    $sth->execute();
                    while ($artigo = $sth->fetchObject()) { //precorrer resultados
                        ?>

                        <div class="col-8 col-sm-6 col-lg-3 pt-3 mx-auto">
                            <div>
                                <a href="sProduct.php?id=<?= $artigo->id ?>">
                                    <img class="img-fluid artigos rounded" src="imagens/produtos/<?=$artigo->imagem?>"
                                        alt="<?=$artigo->nome?>">
                                </a>
                            </div>
                            <div class="text-center text-white pt-2">
                                <a href="sProduct.php?id=<?=$artigo->id?>" class="py-1 text-uppercase fw-bold"
                                    style="text-decoration: none; color: #ffffff">
                                    <?=$artigo->nome?>
                                </a>
                                <div>
                                    <?=$artigo->preco?> €
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <!-- garrafa -->
            <div class="container my-5" id="garrafa">
                <div class="display-5 text-center text-white">Garrafas</div>
                <div class="row">

                    <?php
                    $sth->bindValue(':C', 2);
                    $sth->execute();
                    while ($artigo = $sth->fetchObject()) { //precorrer resultados
                        ?>

                        <div class="col-8 col-sm-6 col-lg-3 pt-3 mx-auto">
                            <div>
                                <a href="sProduct.php?id=<?= $artigo->id ?>">
                                    <img class="img-fluid artigos rounded" src="imagens/produtos/<?= $artigo->imagem ?>"
                                        alt="<?= $artigo->nome ?>">
                                </a>
                            </div>
                            <div class="text-center text-white pt-2">
                                <a href="sProduct.php?id=<?= $artigo->id ?>" class="py-1 text-uppercase fw-bold"
                                    style="text-decoration: none; color: #ffffff">
                                    <?= $artigo->nome ?>
                                </a>
                                <div>
                                    <?= $artigo->preco ?> €
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                
            </div>
        </div>
    </main>

    <footer>
        <?php include_once('includes/footer.php'); ?>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/website.js"></script>

</body>

</html>