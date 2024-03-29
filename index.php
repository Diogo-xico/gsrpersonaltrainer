<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gsrpersonaltrainer</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>



<style>
    .imagem-sec1 {
        background-image: url('imagens/banner-inicial.jpg');
        background-size: cover;
    }

    .reveal {
        position: relative;
        transform: translateY(30px);
        opacity: 0;
        transition: 1s all ease;
    }

    .reveal.active {
        transform: translateY(0);
        opacity: 1;
    }

</style>


<body>
    <?php include_once('includes/connection.php') ?>
    <?php include_once('ajax/guardarVariaveis.php') ?>


    <header>
        <?php include_once('includes/menu.php'); ?>
    </header>
    
    
    <div id="banner-inicial" class="imagem-sec1 w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <?php
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {?>
                <h1 class="texto-imagemsec1 text-white animate__animated animate__fadeInUp" style="font-size:100px;">
                Bem-Vindo(a) <?= $inf->nome?></h1>
                <?php } else { ?><h1 class="texto-imagemsec1 text-white animate__animated animate__fadeInUp" style="font-size:100px;">
                Bem-Vindo(a)</h1>
             <?php } ?>
        </div>
    </div>

    <div id="sobremim" class="sobremim py-5">
        <div class="sub-sobremim d-flex justify-content-center p-5">
            <img class="img-fluid" src="imagens/sobremim.jpeg" alt="Sobre mim-imagem">
        </div>
        <div class="sub-sobremim align-self-center text-white p-5">
            <div class="row">
                <span class="titulo-sobremim fs-5">O teu Persontal Trainer</span>
                <span class="subtitulo-sobremim reveal">
                    <p><strong>Gabriel Rodrigues</strong></p>
                </span>
                <span class="texto-sobremim py-4">
                    <p>Tudo o que iremos trabalhar juntos é fruto da aprendizagem que 
                    desenvolvi ao longo dos anos na área da saúde, fitness, desenvolvimento 
                    pessoal, biologia, e assim vamos atingir os teus objetivos.</p>
                    <p>Vem trabalhar comigo para pudermos encontrar a melhor versão de ti!</p>
                </span>
                <div>
                    <a target="_blank" class="btn btn1" href="https://www.instagram.com/pt_gabrielrodrigues/">
                        <i class="bi bi-instagram pe-2"></i>Contacta-me para mais info
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="planos" class="container-fluid mt-4 p-5">

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

        <h1 class="plano-titulo text-center pb-4">Os teus planos</h1>
        <div class="row">
        <?php
            $query = 'SELECT * FROM plano WHERE visivel = 1';
            $sth = $dbh->prepare($query);
            $sth->execute();
            while($plano = $sth->fetchObject()){
        ?>
            <div class="col-12 col-md-6 col-lg-4 p-4 text-center">
                <div class="plano position-relative reveal">
                <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) { 

                    if($inf->permissao == (1 || 2)) { ?>
                    <h2 class="position-absolute start-0 top-0 pb-2"><?= $plano->id?></h2>
                    <?php }}     ?>
                    <img class="img-fluid pb-2" style="max-width:64px; max-height:64px;" src="imagens/planos/<?= $plano->imagem?>" alt="plano <?= $plano->titulo?>">
                    <h2 class="titulo-subplano pb-2"><?= $plano->titulo?></h2>
                    <div class="pb-2"><?= $plano->descricao?>
                    </div>
                </div>
            </div>
        <?php } if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) { 

                    if($inf->permissao == (1 || 2)) { ?>
                
                       
                       <div class="row">
                        <div class="col-12 col-md-6 pe-2">
                            <button class="btn1 my-3" data-bs-toggle="modal"
                        data-bs-target="#alterarPlano"><i class="bi bi-plus-square"></i> Adicionar Plano </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button class="btn1 my-3" data-bs-toggle="modal"
                        data-bs-target="#removerPlano"><i class="bi bi-dash-square"></i> Remover Plano </button>
                        </div>
                    


                        <div class="modal fade" id="alterarPlano" tabindex="-1" 
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                       
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Adicionar Plano</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-black">
                                        <form action="ajax/adicionarPlano.php" method="post" enctype="multipart/form-data">
                                            <div class="form-floating mb-3 w-100">
                                                <input name="titulo" type="text" class="form-control" maxlength="30" placeholder="Titulo Plano"
                                                    required>
                                                <label for="contactar-email">Título do plano</label>
                                            </div>
                                            <div class="form-floating mb-3 w-100">
                                                <div for="contactar-email">Descrição do Plano</div>
                                                <textarea name="descricao" type="text" maxlength="120" class="form-control" aria-label="With textarea" required></textarea>
                                            </div>
                                            <div class="w-100">
                                                Imagem
                                                <input name="imagem" type="file" class="form-control my-1" required">
                                            </div>
                                            <div class="pt-3">
                                                <button type="submit" class="btn1" >Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                             </div>
                            </div>
                        </div>

                        <div class="modal fade" id="removerPlano" tabindex="-1" 
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                       
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Remover Plano</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-black">
                                        <form action="ajax/removerPlano.php" method="post">
                                            <div class="form-floating mb-3 w-100">
                                                <input name="id" type="number" class="form-control" placeholder="Titulo Plano"
                                                    required>
                                                <label for="contactar-email">ID do plano</label>
                                            </div>
                                            <div class="pt-3">
                                                <button type="submit" class="btn1" >Remover</button>
                                            </div>
                                        </form>
                                    </div>
                             </div>
                            </div>
                        </div>

                        
                    <?php }} ?>
                        
            </div>    
            
        </div>
    </div>

    
    <div id="transformacoes" class="transformacoes pt-5 pb-5 reveal text-white">

        <div class="sub-transformacoes align-self-center text-start text-center p-4">
            <p class="titulo-transformacoes  pt-5">
                Transformações dos meus clientes
            </p>
            <hr>
            <p class="texto-transformacoes pt-3">
                Imagens do Antes e Depois que retratam resultados de casos reais.
            </p>
        </div>

        <div id="carouselExampleControls" class="slider-imagens carousel slide p-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imagens/transformacoes/transformacao-2.jpg" class="d-block w-100 img-fluid"
                        alt="transformacao2">
                </div>
                <div class="carousel-item">
                    <img src="imagens/transformacoes/transformacao-1.jpg" class="d-block w-100 img-fluid"
                        alt="transformacao4">
                </div>
            </div>
            <button class="carousel-control-prev ps-5" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next pe-5" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <div id="contactar" class="container-fluid mt-5 p-5 reveal">
        <form action="#" id="submit">
            <div class="row">
            <div class="col-12 col-lg-6">
                           
                <h1>Tens alguma Dúvida? Contacta-me!</h1>
                <div>Preenche o formulário para poder responder às tuas questões!</div>
                
                    <div class="form-floating mb-3 w-100">
                        <input type="text" class="form-control" name="contactarNome" id="contactar-nome"
                            placeholder="Nome da Pessoa" required>
                        <label for="contactar-nome">O teu nome</label>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <input type="email" class="form-control" name="contactarEmail" id="contactar-email"
                            placeholder="name@example.com" required>
                        <label for="contactar-email">O teu email</label>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <div for="contactar-email">A tua dúvida</div>
                        <textarea class="form-control" aria-label="With textarea" placeholder="name@example.com" id="contactar-pergunta" required></textarea>
                    </div>
                    <div>
                        <div class="col-lg-7 w-50">
                            <button type="submit" class="btn1 my-3 ">Enviar</button>
                        </div>
                    </div>
                
            </div>
        </form>
        

        <div class="col-12 col-lg-6">
                <h1 class="p-2">Perguntas Frequentes</h1>
                <div class="p-2" id="pergunta1">
                    <a class="btn btn2 text-start" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button"
                        aria-expanded="false" aria-controls="multiCollapseExample1">A quem se destina este
                        acompanhamento?</a>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse  my-3" id="multiCollapseExample1">
                                <div class="card card-body">
                                    <div>
                                        <p>Este acompanhamento é para todas as pessoas que quiserem evoluir. A
                                            acompanhamento
                                            adapta-se ao
                                            objetivo e ao estilo de vida de cada um desde:</p>
                                        <p> - a mãe/pai ocupada(o) que tem o tempo contado</p>
                                        <p> - a mãe/pai ocupada(o) que tem o tempo contado</p> 
                                        <p> - empresário de sucesso que precisa cuidar da sua imagem e da sua saúde</p> 
                                    

                                        Para todos aqueles que vêm o corpo como uma ferramenta importante da tríade (
                                        corpo, mente e
                                        alma) para alcançar o sucesso e o equilíbrio em todas as áreas da sua vida.

                                        Para todas as pessoas que querem ser mais, fazer mais e viver mais.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2" id="pergunta2">
                    <a class="btn btn2 text-start" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button"
                        aria-expanded="false" aria-controls="multiCollapseExample1">Em que consiste o Online
                        Coaching?</a>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse my-3" id="multiCollapseExample2">
                                <div class="card card-body">
                                    Consiste num acompanhamento de personal training à distancia. Um acompanhamento
                                    super completo a todos os níveis mas sem a vertente presencial nos teus treinos.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="p-2" id="pergunta3">
                    <a class="btn btn2 text-start" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button"
                        aria-expanded="false" aria-controls="multiCollapseExample1">Com que frequência são alterados os
                        planos?</a>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse my-3" id="multiCollapseExample3">
                                <div class="card card-body">
                                    Os planos são alterados mediante a evolução apresentada e apenas quando há
                                    necessidade. Os planos de treino têm por norma a duração de 4 a 8 semanas.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2" id="pergunta4">
                    <a class="btn btn2 text-start" data-bs-toggle="collapse" href="#multiCollapseExample4" role="button"
                        aria-expanded="false" aria-controls="multiCollapseExample4">Apenas posso treinar em casa, é possível?</a>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse my-3" id="multiCollapseExample4">
                                <div class="card card-body">
                                    Sem dúvida. Nós adaptamos os treinos para qualquer que seja a realidade vivida pelo cliente.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <footer>
        <?php include_once('includes/footer.php'); ?>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="js/website.js"></script>

    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");

            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;

                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }

            }
        }

        window.addEventListener("scroll", reveal);

    </script>

    <script type="text/javascript">
        var nav = document.querySelector('nav');

        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 100) {
                nav.classList.add('bg-dark', 'shadow');
            } else {
                nav.classList.remove('bg-dark', 'shadow');
            }
        });
    </script>
 
    <script>


            

        const nome= document.getElementById('contactar-nome')
        const email= document.getElementById('contactar-email')
        const pergunta= document.getElementById('contactar-pergunta')
        const submit = document.getElementById('submit');

        submit.addEventListener('submit',(e)=>{
            
            e.preventDefault();
            
            Email.send({
            SecureToken : "50e654bf-6cda-4c6f-8236-db845e4275cd",
            To : 'diogoferrfrancisco@gmail.com',
            From: 'diogoferrfrancisco@gmail.com',
            Subject : "Pergunta Cliente",
            Body: `Nome: ${nome.value} <br> Email: ${email.value} <br> Pergunta: ${pergunta.value}`,
            }).then(
            message => alert(message)
            );
            

        })

            
            const btns = document.querySelectorAll(".btn2");

            
            btns.forEach(btn => {
            btn.addEventListener("click", function() {
                const thisCollapse = this.nextElementSibling;
      
                const siblings = Array.from(this.parentNode.parentNode.children);
                siblings.forEach(sibling => {
                const collapse = sibling.querySelector(".collapse.show");
                if (collapse && collapse !== thisCollapse) {
                    const bsCollapse = new bootstrap.Collapse(collapse);
                    bsCollapse.hide();
                }
                });
            });
            });
        
           
    </script>

</body>

</html>