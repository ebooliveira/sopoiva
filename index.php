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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Noticias aqui em Breve</h5>
                            <p class="card-text">Descrição das noticias em breve tudo aqui.</p>
                            <a href="#" class="btn btn-dark">Mais detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="badge bg-dark text-white">Top5 Mais Escalados!</label>
                    <!--Chamar Função mais escalados-->
                    <?php
                    require_once 'api/maisEscalados.php';
                    $mais_escalados = MaisEscalados();
                    echo $mais_escalados;
                    ?>
                </div>
                <div class="col-md-4">
                    <label class="badge bg-dark text-white">Reservas Mais Escaladas!</label>
                    <!--Chamar Função mais escalados-->
                    <?php
                    require_once 'api/maisEscaladosReservas.php';
                    $mais_escalados_Reservas = ReservasMaisEscalados();
                    echo $mais_escalados_Reservas;
                    ?>
                </div>
                <div class="col-md-4">
                    <label class="badge bg-dark text-white">Melhor por Média!</label>
                    <!--Chamar Função mais escalados-->
                    <?php
                    require_once 'api/timesAtualRodada.php';
                    $atualRodada = timesAtualRodada();
                    echo $atualRodada;
                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <label class="badge bg-dark text-white">Melhor por Média!</label>
                    <!--Chamar Função mais escalados-->
                    <?php
                    require_once 'api/melhorPorMedia.php';
                    $melhor = melhorPorMedia();
                    echo $melhor;
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>