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

    }
</style>

<body id="body-estilo2">
    <?php include_once('includes/connection.php') ?>
    <?php include_once('ajax/guardarVariaveis.php') ?>

    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>

    <div id="editar-perfil" class="container-fluid mt-5 p-5 reveal text-white justify-content-center">



        <form name="editarUser" action="ajax/alterarDadosUtilizador.php" method="POST" enctype="multipart/form-data">

            <div class="row">

                <?php

                if (isset($_GET['error'])) {

                    if ($_GET['error'] == 'dadosIncorretos') {
                        ?>
                        <small class="alert alert-danger text-center"> Dados incorretos ou em falta</small>
                        <?php
                    } else if ($_GET['error'] == 'imagemInvalida') {
                        ?>
                            <small class="alert alert-danger text-center"> Imagem Inválida</small>
                        <?php
                    } else if ($_GET['error'] == 'tamanhoImagem') {
                        ?>
                                <small class="alert alert-danger"> A imagem só pode ter no máximo 5MBs</small>
                        <?php
                    } else if ($_GET['error'] == 'ficheiroInvalido') {
                        ?>
                                    <small class="alert alert-danger"> O ficheiro só pode ser do formato PNG, JPG OU JPEG </small>
                        <?php
                    }
                }
                ?>


                <div class=" fs-1 text-center pb-3 text-white" >Dados Pessoais</div>
                <div class="imagem-perfil col-12 col-lg-4">
                    <div class="d-flex justify-content-center pb-2">
                        <img src="public/<?= $inf->imagem ?>" class="img-thumbnail" alt="..." style="max-width:300px">
                    </div>
                    <div class="w-100">
                        Imagem
                        <input name="userImage" type="file" class="form-control my-1" value="<?= $inf->imagem ?>">
                    </div>
                </div>

                <div class="titulo col-12 col-lg-4 p-3">

                    <div class="w-100">
                        Primeiro Nome
                        <input name="userNome" type="text" class="form-control my-1" value="<?= $inf->nome ?>">
                    </div>
                    <div class="w-100">
                        Último Nome
                        <input name="userSobreNome" type="text" class="form-control my-1"
                            value="<?= $inf->sobrenome ?>">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="pe-2">
                            Idade
                            <input name="userIdade" min="10" max="120" type="number" class="form-control my-1"
                                value="<?= $inf->idade ?>">
                        </div>
                        <div class="pe-2">
                            Altura(Cm)
                            <input name="userAltura" min="75" max="250" type="number" class="form-control my-1"
                                value="<?= $inf->altura ?>">
                        </div>
                        <div class="">
                            Peso(Kg)
                            <input name="userPeso" min="30" max="150" type="number" class="form-control my-1"
                                value="<?= $inf->peso ?>">
                        </div>
                    </div>
                    <div>
                        Email
                        <input name="userMail" type="text" class="form-control my-1 w-100" value="<?= $inf->email ?>">
                    </div>

                </div>

                <div class="titulo col-12 col-lg-4 p-3">

                    <div class="w-100">
                        Palavra Passe
                        <input name="userPalavraPasse" type="password" class="form-control my-1"
                            value="<?= $inf->palavraPasse ?>">
                    </div>
                    <div class="w-100">
                        Morada
                        <input name="userMorada" type="text" class="form-control my-1" value="<?= $inf->morada ?>">
                    </div>
                    <div class="w-100">
                        Localidade
                        <input name="userLocalidade" type="text" class="form-control my-1"
                            value="<?= $inf->localidade ?>">
                    </div>

                    <div class="w-100 pb-3">
                        Código Postal
                        <input name="userCodigoPostal" type="text" maxlength="8" class="form-control my-1"
                            value="<?= $inf->codigoPostal ?>">
                    </div>
                </div>

                <div class="w-100">
                    <button type="button" class="btn1 mt-1 mb-3" data-bs-toggle="modal"
                        data-bs-target="#confirmarAlteracao">Alterar Dados</button>
                </div>

                <div class="modal fade" id="confirmarAlteracao" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Aviso</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-black">
                                <div> Tem a certeza que pretende guardar as alterações?</div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update" class="btn1" value="update">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>





        </form>


    </div>

    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>