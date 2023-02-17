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
            <div class="container-fluid mt-5 pt-2 text-white" id="camisola">
                <div class="display-5 text-center">Camisolas</div>
                <div class="row">

                    <?php 
                    $sth->bindValue(':C', 1);
                    $sth->execute();
                    while($artigo = $sth->fetchObject()){ //precorrer resultados
                    ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2 pt-3">
                        <div class="camisola position-relative">  
                            <a href="mostrarArtigo.php?id=<?= $artigo->id?>" class="py-1 text-uppercase fw-bold">
                                <img class="img-fluid artigos rounded" src="imagens/<?= $artigo->imagem?>" alt="<?= $artigo->nome?>">
                            </a>
                        </div>    
                        <div class="camisola position-relative pt-2 text-center">
                            <a href="mostrarArtigo.php?id=<?= $artigo->id?>" class="py-1 text-uppercase fw-bold" style="text-decoration: none">
                                <?= $artigo->nome?>
                            </a>
                            <div><span><?= $artigo->preco?> €</span></div>             
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>     
            </div>
            <!-- garrafa -->
            <div class="container-fluid my-5 pb-2 text-white" id="garrafa">
                <div class="display-5 text-center">Garrafas</div>
                <div class="row">

                    <?php 
                    $sth->bindValue(':C', 2);
                    $sth->execute();
                    while($artigo = $sth->fetchObject()){ //precorrer resultados
                    ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2 pt-3">
                        <div class="garrafa position-relative"> 
                            <a href="mostrarArtigo.php?id=<?= $artigo->id ?>" class="py-1 text-uppercase fw-bold">
                                <img class="img-fluid artigos rounded" src="imagens/<?= $artigo->imagem?>" alt="<?= $artigo->nome?>">
                            </a>
                        </div>    
                        <div class="garrafa position-relative pt-2 text-center">
                            <a href="mostrarArtigo.php?id=<?= $artigo->id ?>" class="py-1 text-uppercase fw-bold" style="text-decoration: none">
                                <?= $artigo->nome?>
                            </a>
                            <div><span><?= $artigo->preco?> €</span></div>              
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>     
            </div>

    <footer>
        <?php include_once('includes/footer.php'); ?>
    </footer>
        
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/website.js"></script>

</body>
</html>