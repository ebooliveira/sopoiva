<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoPoiva V5</title> <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="collapse" id="NavbarPrincipal">
            <div class="bg-dark p-4">
                <h5 class="text-white h4">Cartola FC - SoPoiva</h5>
                <span class="text-muted">Tudo sobre o CartolaFC</span>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#NavbarPrincipal" aria-controls="NavbarPrincipal" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                require_once 'api/mercadoFecha.php';
                $mercado = MercadoFecha();
                echo $mercado;
                ?>
            </div>

        </nav>
        <div class="container">
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <?php
                        require_once 'views/SearchTweet.php';
                        $Twiiter = exibirTweets($result);
                        echo $Twiiter;
                        ?>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4">
                    <span class="d-block p-2 bg-success text-white">Mais Escalados!</span>
                    <title>Escalados</title>
                    <?php
                    require_once 'views/MaisEscalados.php';
                    // SE FUNÇÃO MAIS ESCALADOS ESTIVER OK, EXIBA. CASO CONTRÁRIO, EXIBA UMA MESAGEM DE ERRO.
                    $melhor1 = MaisEscalados1();
                    echo $melhor1;
                    ?>
                </div>
                <div class="col-md-4 ">
                    <span class="d-block p-2 bg-success text-white">Reservas!</span>
                    <!--Chamar Função mais escalados-->
                    <?php
                    require_once 'views/Reservas.php';
                    $reservas = Reservas();
                    echo $reservas;
                    ?>
                </div>
                <div class="col-md-4">
                    <div>
                        <?php
                        require_once 'api/timesAtualRodada.php';
                        require_once 'api/api.php';
                        ?>
                        <span class="d-block p-2 bg-success text-white">Rodada #<?php echo $statusMercado['rodada_atual']; ?></span>
                        <?php
                        $atualRodada = timesAtualRodada();
                        echo $atualRodada;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- RODAPE -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Cartola FC - SoPoiva - <?php echo date('Y'); ?></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>