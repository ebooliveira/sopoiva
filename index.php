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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    <?php
                    require_once 'api/mercadoFecha.php';
                    $mercado = MercadoFecha();
                    echo $mercado;
                    ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"> <span class="badge bg-success"> <?php require_once 'api/api.php';
                                                                                                    echo number_format($statusMercado['times_escalados'], 0, '.', '.') ?> Times Escalados</span> </a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Buscar Time" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>
        <br>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" id="confrontos-tab" type="button" data-bs-target="#confrontos" role="tab" aria-controls="confrontos" aria-selected="true">#<?php echo $statusMercado['rodada_atual']; ?></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" id="maisescalados-tab" type="button" data-bs-target="#maisescalados" role="tab" aria-controls="maisescalados" aria-selected="false">Titulares</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" id="reservas-tab" type="button" data-bs-target="#reservas" role="tab" aria-controls="reservas" aria-selected="false">Reservas</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" id="capitao-tab" type="button" data-bs-target="#capitao" role="tab" aria-controls="capitao" aria-selected="false">Capitão</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="confrontos" role="tabpanel" aria-labelledby="confrontos-tab">
                                    <div>
                                        <?php
                                        require __DIR__  . '/Views/Confrontos.php';
                                        $times = Times();
                                        echo $times;
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="maisescalados" role="tabpanel" aria-labelledby="maisescalados-tab">

                                    <div>
                                        <?php
                                        require __DIR__  . '/Views/maisescalados.php';
                                        $melhor1 = MaisEscalados1();
                                        echo $melhor1;
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reservas" role="tabpanel" aria-labelledby="reservas-tab">

                                    <div class="col-12">
                                        <?php
                                        require __DIR__ . '/Views/reservas.php';
                                        $reservas = Reservas();
                                        echo $reservas;
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="capitao" role="tabpanel" aria-labelledby="capitao-tab">

                                    <div class="col-12">
                                        <?php
                                        require __DIR__ . '/Views/capitao.php';
                                        $capitao = Capitao();
                                        echo $capitao;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-lg-8 col-md-6 col-sm-12 col-12">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" id="twitter-tab" type="button" data-bs-target="#twitter" role="tab" aria-controls="twitter" aria-selected="true">Twitter</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                            <div class="tab-content" id="myTabPrincipal">
                                <div class="tab-pane fade show active" id="twitter" role="tabpanel" aria-labelledby="twitter-tab">
                                    <div>
                                        <?php
                                        require __DIR__  . '/Views/SearchTweet.php';
                                        $twitter = Twitter($result);
                                        echo $twitter;
                                        ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- RODAPE -->
    <br>
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