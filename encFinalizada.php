<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Encomenda Finalizada</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>

    .footer-encFinalizada {
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>

<body id="body-artigo">

    <?php include_once('includes/connection.php') ?>

    <?php

    if (isset($_SESSION['id']))
        $clientId = $_SESSION['id'];
    else
        $clientId = 0;

    $sql = 'SELECT * FROM utilizadores WHERE id = :id ';

    $sth = $dbh->prepare($sql);
    $sth->bindParam('id', $clientId);
    $sth->execute();

    $inf = $sth->fetchObject();

    ?>

    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>

    <div class="container contentor ">

        <div class="row mx-auto my-5 py-5">
            <div class="col-12 text-center">
                <h2 class="py-3">Encomenda Finalizada!</h2>
                <h5 class="py-2">Obrigado por fazer a sua encomenda no nosso website de um dos nossos artigos!</h5>
                <h5 class="py-2">Receberá a sua encomenda entre 5 a 10 dias úteis.</h5>
                <h5 class="py-2">Para o esclarecimento de qualquer dúvida basta entrar em contacto comigo preenchendo o
                    formulário na secção das <a href="index.php#contactar" style="color:#000000;">Perguntas
                        Frequentes</a>.</h5>
                <h5 class="pt-5 pb-3"><a href="index.php" style="text-decoration:none; color:#000000;">
                        Para voltar para a página principal clique <a href="index.php"
                            style="color:#000000;">aqui</a>.</a></h5>
                <h5 class="pt-3 pb-3 mb-5"><a href="loja.php" style="text-decoration:none; color:#000000;">
                        Para continuar a comprar na nossa loja clique <a href="loja.php"
                            style="color:#000000;">aqui</a>.</a></h5>
            </div>
        </div>
    </div>

    <footer class="footer-encFinalizada">
        <?php include_once('includes/footer.php'); ?>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>