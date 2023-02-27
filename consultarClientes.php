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
    <?php include_once('ajax/guardarVariaveis.php')?>
    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>

    <?php
    
        $query = 'SELECT * FROM utilizadores';
        $sth = $dbh->prepare($query);  
        
    if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) { 

        if($inf->permissao == (1 || 2)) { ?>

    

    <div class="container my-5 py-5">
        <div class="titulo-transformacoes  text-center text-white">
            Listagem de Utilizadores
        </div>
        <?php
                        $sth->execute();
                        while($user = $sth->fetchObject()){
                    ?>
        <div class="d-flex p-1 justify-content-center">
            <a href="perfilUtilizadorAdmin.php?id=<?= $user->id?>" class="btn btn2 text-start text-center w-100">ID:
                <?=$user->id?> Nome:
                <?=$user->nome?> <?=$user->sobrenome?></a>
        </div>
        <?php }?>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <button class="btn1 my-3 " data-bs-toggle="modal"
                data-bs-target="#atribuirperms"><i class="bi bi-plus-square"></i> Atribuir Permissões </button>
            </div>
            <?php
            if($inf->permissao == 2) { ?>
            <div class="col-12 col-md-6">
                <button class="btn1 my-3 " data-bs-toggle="modal"
                data-bs-target="#removerperms"><i class="bi bi-dash-square"></i> Remover Permissões </button>
            </div>
        <?php } ?>
        </div>
        <div class="modal fade" id="atribuirperms" tabindex="-1" 
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                       
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Atribuir Permissões</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-black">
                                        <form action="ajax/atribuirperms.php" method="post">
                                            <div class="form-floating mb-3 w-100">
                                                <input name="id" type="number" class="form-control" placeholder="Titulo Plano"
                                                    required>
                                                <label for="utilizador-id">ID do utilizador</label>
                                            </div>
                                            <div class="pt-3">
                                                <button type="submit" class="btn1" >Atribuir</button>
                                            </div>
                                        </form>
                                    </div>
                             </div>
                            </div>
                        </div>

                        <div class="modal fade" id="removerperms" tabindex="-1" 
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                       
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Remover Permissões</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-black">
                                        <form action="ajax/removerperms.php" method="post">
                                            <div class="form-floating mb-3 w-100">
                                                <input name="id" type="number" class="form-control" placeholder="Titulo Plano"
                                                    required>
                                                <label for="utilizador-id">ID do utilizador</label>
                                            </div>
                                            <div class="pt-3">
                                                <button type="submit" class="btn1" >Remover</button>
                                            </div>
                                        </form>
                                    </div>
                             </div>
                            </div>
                        </div>


    </div>
    
    <?php } else { ?>
    <div
        style=" background: linear-gradient(180deg, rgba(189, 152, 113, 0.8186624991793592) 0%, rgba(33, 37, 41, 1) 50%), min-height: 100vh;">
        <div class="container pt-5">

            <div class="row">
                <div class="col-md-8 text-center mx-auto">
                    <div class=" text-uppercase mt-5 fs-1">Ups, não devias estar aqui.</div>
                    <div class="info fs-5">Clica
                        <a href="index.php" class="titulo"> aqui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

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
    <script src="js/bootstrap.bundle.min.js"></script>
</body>