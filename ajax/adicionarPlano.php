<?php
session_start();
include_once('../includes/connection.php');


$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$imagem = $_Files['imagem'];


$img_name = $_FILES['imagem']['name'];
    $img_size = $_FILES['imagem']['size'];
    $tpm_name = $_FILES['imagem']['tmp_name'];
    $error = $_FILES['imagem']['error'];

    
    if ($error === 0) {

        if ($img_size > 1000000) {
            header('Location:../index.php?error=tamanhoImagem');
            exit;
        } else {
            $image_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $image_ex_lc = strtolower($image_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($image_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $image_ex_lc;
                $img_uploadpath = '../imagens/planos/' . $new_img_name;
                move_uploaded_file($tpm_name, $img_uploadpath);

                $sql = 'INSERT INTO plano (titulo, descricao, imagem) VALUES
                        (:titulo, :descricao, :imagem);';


                $sth = $dbh->prepare($sql);
                $sth->bindParam('titulo', $titulo);
                $sth->bindParam('descricao', $descricao);
                $sth->bindParam('imagem', $new_img_name);

                $sth->execute();


                header('Location:../index.php');
                $sth = null;

                die();            
                
            } else {
                header('Location:../index.php?error=ficheiroInvalido');
                exit;
            }
        }

    } else {
        header('Location:../index.php?error=imagemInvalida');
        exit;
    }
      
?>



$sql = 'INSERT INTO plno (titulo, descricao, imagem) VALUES
(:titulo, :descricao, :imagem);';


    $sth = $dbh->prepare($sql);
    $sth->bindParam('email', $email);
    $sth->bindParam('nome', $nome);
    $sth->bindParam('sobrenome', $sobrenome);
    $sth->bindParam('idade', $idade);
    $sth->bindParam('palavraPasse', $palavraPasse);

    if (
        empty($email) || empty($nome) || empty($sobrenome) || empty($idade) || empty($palavraPasse) 
    ) {
        header('Location:../registarUser.php?error=dadosIncorretos');
        exit;
    }

    $sth->execute();

        


header('Location:../loginUser.php'); 
$sth = null;

die();
?>