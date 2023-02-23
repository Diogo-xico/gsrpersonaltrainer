<?php session_start(); ?>

<?php
    require('../includes/connection.php');
    

    $email = $_POST['userMail'];
    $nome = $_POST['userNome'];
    $sobrenome = $_POST['userSobreNome'];
    $idade = $_POST['userIdade'];
    $palavraPasse = $_POST['userPalavraPasse'];
    $peso = $_POST['userPeso'];
    $altura = $_POST['userAltura'];
    $codigoPostal = $_POST['userCodigoPostal'];
    $localidade = $_POST['userLocalidade'];
    $morada = $_POST['userMorada'];
    $imagem = $_Files['userImage'];
    

    if (isset($_SESSION['id'])){
        $clientId = $_SESSION['id'];
    }
    
    $img_name = $_FILES['userImage']['name'];
    $img_size = $_FILES['userImage']['size'];
    $tpm_name = $_FILES['userImage']['tmp_name'];
    $error = $_FILES['userImage']['error'];

    
    if ($error === 0) {

        if ($img_size > 5000000) {
            header('Location:../editarUser.php?error=tamanhoImagem');
            exit;
        } else {
            $image_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $image_ex_lc = strtolower($image_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($image_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $image_ex_lc;
                $img_uploadpath = '../public/' . $new_img_name;
                move_uploaded_file($tpm_name, $img_uploadpath);

                $sql = 'UPDATE utilizadores SET email=:email, nome=:nome, sobrenome=:sobrenome, idade=:idade, palavraPasse=:palavraPasse, peso=:peso, altura=:altura, codigoPostal=:codigoPostal, localidade=:localidade, morada=:morada, imagem=:imagem WHERE id=:id';


                $sth = $dbh->prepare($sql);
                $sth->bindParam('id', $clientId);
                $sth->bindParam('email', $email);
                $sth->bindParam('nome', $nome);
                $sth->bindParam('sobrenome', $sobrenome);
                $sth->bindParam('idade', $idade);
                $sth->bindParam('palavraPasse', $palavraPasse);
                $sth->bindParam('peso', $peso);
                $sth->bindParam('altura', $altura);
                $sth->bindParam('codigoPostal', $codigoPostal);
                $sth->bindParam('localidade', $localidade);
                $sth->bindParam('morada', $morada);
                $sth->bindParam('imagem', $new_img_name);

                if (
                    empty($email) || empty($nome) || empty($sobrenome) || empty($idade) || empty($palavraPasse) || empty($peso) || empty($altura) || empty($codigoPostal)
                    || empty($localidade) || empty($morada) || empty($morada || empty($imagem))
                ) {
                    header('Location:../editarUser.php?error=dadosIncorretos');
                    exit;
                }

                $sth->execute();


                header('Location:../perfilUtilizador.php');
                $sth = null;

                die();            
                
            } else {
                header('Location:../editarUser.php?error=ficheiroInvalido');
                exit;
            }
        }

    } else {
        header('Location:../editarUser.php?error=imagemInvalida');
        exit;
    }
      
?>