
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
    <?php include_once('ajax/guardarVariaveis.php') ?>
    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>

    <?php
    
        $query = 'SELECT * FROM utilizadores';
        $sth = $dbh->prepare($query);  
        
     ?>


    <div class="titulo-transformacoes pt-5 pb-5 text-center text-white">    
                Listagem de Utilizadores
    </div>

    <div class="container">
    <?php
        $sth->execute();
        $user = $sth->fetchObject();
        while($user = $sth->fetchObject()){
    ?>
        <div class="p-1">
                    <a href="perfilUtilizadorAdmin.php?id=<?= $user->id?>" class="btn btn2 text-start">ID: <?=$user->id?> Nome: <?=$user->nome?> <?=$user->sobrenome?></a>
        </div>
        
    <?php  } ?>
    </div>

</body>