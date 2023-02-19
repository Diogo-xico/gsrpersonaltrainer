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
    .barra-fixa-login {
        position: static;
    }

    @media (min-width:992px) {

        .barra-fixa-login {
            position: sticky;

        }

        .img {

            max-width: 200px;

        }

    }
</style>

<body id="body-estilo2">
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
            <div class="d-flex justify-content-center">
                <img src="public/<?= $inf->imagem ?>" class="img-thumbnail" alt="..." style="max-width:300px">

            </div>
            <div class="titulo-transformacoes pt-5 pb-5 text-center ">
                <?= $inf->nome ?>
                <?= $inf->sobrenome ?>
            </div>
            <div class="informacoes row text-center">
                <div class="col-12 col-lg-6 p-3">
                    <div class="pb-3 fs-2" style="color: #bd9871;">Dados Pessoais</div>
                    <div class="pb-3 fs-3">Morada:
                        <?= $inf->morada ?>
                    </div>
                    <div class="pb-3 fs-3">Localidade:
                        <?= $inf->localidade ?>
                    </div>
                    <div class="pb-3 fs-3">Código-Postal:
                        <?= $inf->codigoPostal ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-3">

                    <div class="pb-3 fs-3">Email:
                        <?= $inf->email ?>
                    </div>
                    <div class="pb-3 fs-3">Idade:
                        <?= $inf->idade ?>
                    </div>
                    <div class="pb-3 fs-3">Altura:
                        <?= $inf->altura ?>
                    </div>
                    <div class="fs-3">Peso:
                        <?= $inf->peso ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center pb-3">
                    <a href="editarUser.php" class="btn btn1 mt-1 mb-3 text-center w-50" role="button">Editar Dados</a>
                </div>
            <?php } else { ?>

                <div
                    style=" background: linear-gradient(180deg, rgba(189, 152, 113, 0.8186624991793592) 0%, rgba(33, 37, 41, 1) 50%), min-height: 100vh;">
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