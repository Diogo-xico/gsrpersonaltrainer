<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registar</title>
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

}
</style>

<body id="body-estilo1">
    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>
    <?php include_once('includes/connection.php') ?>
    <div class="container contentor p-5">
        <div class="row linha g-0 shadow">
            <div class="formulario-registar col-lg-5 p-5 bg-dark">

                <?php
                    if(isset($_GET['error'])){
                        if ($_GET['error'] == 'dadosIncorretos') {
                            ?>
                <small class="alert alert-danger text-center pb-2"> Dados incorretos ou em falta</small>
                <?php
                        }
                     }   
                    ?>

                <h4 class="text-white pt-2">Faz já o teu registo!</h4>
                <form name="formregisto" action="ajax/registoUtilizador.php" method="POST">

                    <div class="form-row col-lg-7 w-100">
                        <input name="nome" type="text" placeholder="Primeiro Nome" class="form-control my-3">
                    </div>
                    <div class="form-row col-lg-7 w-100">
                        <input name="sobrenome" type="text" placeholder="Último Nome" class="form-control my-3">
                    </div>
                    <div class="form-row col-lg-7">
                        <input name="idade" type="number" min="10" max="120" placeholder="Idade"
                            class="form-control my-3">
                    </div>
                    <div class="form-row col-lg-7 w-1">
                        <input name="email" type="email" placeholder="Email" class="form-control my-3">
                    </div>
                    <div name="palavraPasse" class="form-row col-lg-7">
                        <label class="text-white">Password</label>
                        <input name="palavraPasse" type="password" placeholder="******" class="form-control my-3">
                    </div>
                    <div class="form-row col-lg-7">
                        <button type="submit" class="btn1 mt-1 mb-3">Registar</button>
                    </div>
                    <a class="pb-2" href="loginUser.php">Já tenho uma conta</a>
                </form>
            </div>
            <div class="imagem-registar col-lg-7 d-flex">
                <img src="imagens/banner-2.jpg" class=" img-fluid" alt="Banner2">
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>