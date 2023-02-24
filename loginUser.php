<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
    <?php include_once('includes/connection.php') ?>

    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>

    <div class="container contentor">
        <div class="row linha g-0 shadow">
            <div class="imagem-login col-lg-7 d-flex">
                <img src="imagens/banner-inicial.jpg" class=" img-fluid" alt="Banner">
            </div>
            <div class="formulario-login col-lg-5 px-5 py-5 bg-dark ">


                <form action="includes/loginUtilizador.php" method="post">
                    <div class="form-floating mb-3 w-100">
                        <input name="emailLogin" type="email" class="form-control" placeholder="name@example.com"
                            required>
                        <label for="contactar-email">O teu email</label>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <input name="passwordLogin" type="password" class="form-control" required
                            placeholder="name@example.com">
                        <label for="contactar-email">Password</label>
                    </div>
                    <div class="form-row col-lg-7">
                        <button class="btn1 mt-1 mb-3" type="submit">Login</button>
                    </div>
                    <a class="pb-2" href="registarUser.php">Não tens Conta?</a>
                </form>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>