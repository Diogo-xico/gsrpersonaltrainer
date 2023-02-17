<!-- menu principal -->

<head>
    <style>
        .texto a:hover {
            color: #bd9871;
        }
        
        #shop-cart::-webkit-scrollbar {
            display: none;
        }

        #shop-cart {
            position: fixed;
            background: #212529;
            right: 0;
            width: 300px;
            height: 100%;
            z-index: 999;
            color: #efefef;          
            overflow-y: scroll;
            -ms-overflow-style: none;
        }

        #shop-cart .p-cart {
            display: flex;
            padding: .8rem;
        }

    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top barra-fixa-login">

    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">
            <img src="imagens/logo-dourado.png" alt="Logo" width="100" height="60">
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu-principal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu-principal">
            <div class="texto navbar-nav mx-auto">
                <a href="index.php#sobremim" class="nav-link">Sobre Mim</a>
                <a href="index.php#planos" class="nav-link">Planos</a>
                <a href="index.php#transformacoes" class="nav-link">Transformações</a>
                <a href="index.php#contactar" class="nav-link">Contactos</a>
                <a href="index.php#contactar" class="nav-link">Perguntas Frequentes</a>
                <a href="loja.php" class="nav-link">Loja</a>

            </div>
            <?php
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
                ?>
                <div class="d-flex align-items-center"><a class="text-white me-3" href="perfilUtilizador.php"><i
                            class="bi bi-person"></i></a>
                <?php } else { ?>

                    <div class="d-flex align-items-center"><a class="text-white me-3" href="loginUser.php"><i
                                class="bi bi-person"></i></a>

                    <?php } ?>

                    <?php
                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
                        ?>
                        <div class="d-flex align-items-center"><a class="text-white me-3"
                                href="includes/logoutUtilizador.php" ><i class="bi bi-box-arrow-right"></i></a>

                        <?php } ?>
                        <div class="d-flex alignt-items-center me-3" id="btn-shop-cart" class="text-white me-3">
                            <i class="bi bi-cart position-relative text-white"></i>
                        </div>

                    </div>


                </div>



</nav>

<!-- carrinho -->
<div id="shop-cart" class="d-none pt-5">
    <div id="shop-cart-content" class="text-center">

        <?php

        if (isset($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $carrinho) {
                $total = 0;
                $quantidade = 0;
                $idProduto = $carrinho['idproduto'];
                $sth = $dbh->prepare("SELECT * FROM produtos WHERE id= :idproduto");
                $sth->bindParam(':idproduto', $idProduto);
                $sth->execute();
                $artigo = $sth->fetchObject();
                $total = $carrinho['precoproduto'] * $carrinho['quantidadeproduto'];
                ?>

                <div class="pt-5 d-md-flex justify-content-md-end">
                    <form action="ajax/removerCarrinho.php" method="post">
                        <input type="hidden" name="idProduto" value="<?= $artigo->id ?>">
                        <button type="submit" class="btn-close btn-close-white px-4" aria-label="Close"></button>
                    </form>
                </div> 

                <img src="imagens/<?= $artigo->imagem ?>" class="p-3 opacity-75" style="width:55%" alt="<?= $artigo->nome?>"></img>
                <div>
                    <div class="fs-6 text-uppercase">
                        <?= $carrinho['nomeproduto'] ?>
                    </div>
                    <div class="fs-6 text-center">
                        Preço: <?= $carrinho['precoproduto'] ?> € 
                    </div>
                    <?php if(($artigo -> categoria) === 1) { ?>
                        <div class="fs-6 text-center">
                        Tamanho: <?= $carrinho['tamanhoproduto'] ?>
                    </div>
                    <?php } else { ?>
                    <div class="fs-6 text-center">
                        Cor: <?= $carrinho['tamanhoproduto'] ?>
                    </div>
                    <?php } ?>
                    <div class="fs-6 text-center">
                        Quantidade: <?= $carrinho['quantidadeproduto'] ?>
                    </div>
                    <div class="fs-6 text-center pt-2">
                        Semi-Total: <?= $total ?> €
                    </div>
                    <hr class="text-white">
                </div>
                <?php 
            } 
        } ?>


    <?php
    if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
    ?> 
        
        <div class="my-5 mx-4">
            <a href="vercarrinho.php" ><button class="btn1">Ver carrinho</button></a>
        </div>      
        
    <?php } else { ?>

        <div class="my-5 mx-4">
            <a href="loginUser.php" ><button class="btn1 ">Ver carrinho</button></a>
        </div>   

    <?php } ?>
    </div>
</div>