<?php

include_once("../../Controler/protect.php");

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['id_usu'];

if (isset($_SESSION['laboratorios'])) {

    $laboratorios = $_SESSION['laboratorios'];
}


if(isset($_SESSION['laboratorios'])){

    unset($_SESSION['laboratorios']);
    
  }
  

if (isset($_SESSION['LabsNaoDisponiveis'])) {

    $labsNaoDisponiveis = $_SESSION['LabsNaoDisponiveis'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Laboratórios Informática</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Poppins:wght@500&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="../css/user/laboratorio.css">





    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>

    <!-- NavBar para mobile -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">

        <a class="navbar-brand" href="#"><img style="height: 50px; width: 50px; margin-left: 4vh;"
                src="../img/logo.png"></a>

        <a class="nav-link text-white" id="navtext">Sistema de Gerenciamento</a>
        <div class="mobile-menu" onclick="Mudarestado('hidden')">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul id="hidden" class="hidden" style="display: none;">
            <li class="nav-item">
                <a class="nav-link text-white" style="text-align: center;" href="Minhas_reservas.php">Reservas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" id="navexit" href="../../Controler/logout.php">Sair <i
                        class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>

        <!-- NavBar pc -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto" id="navlist">
                <li class="nav-item">
                    <a class="nav-link text-white" style="margin-right: 10vh;" href="Minhas_reservas.php">Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;"
                        href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>

        </div>
    </nav>
    <!-- NavBar FIM -->

    <h2 id="titulo" class="text-center p-3">Laboratórios & Auditório </h2>

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="box">
                    <form action="../../Controler/user/consultar_labs.php" method="POST">

                        <div class="mb-3">
                            <label for="periodo" class="form-label">Selecione o Período</label>
                            <select class="form-select border-0 border-bottom" required name="periodo" id="periodo">
                                <option value="manha">Manhã</option>
                                <option value="tarde">Tarde</option>
                                <option value="noite">Noite</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" required name="data" class="form-control border-0 border-bottom"
                                 max="2024-01-01" id="data">
                        </div>
                        <div class="mb-3">
                            <label for="horario" class="form-label">Horário</label>
                            <select class="form-select border-0 border-bottom" required name="horario-selecionado"
                                id="horario">

                            </select>
                        </div>
                        <div class="mb-3">
                        <label for="tipo_lab" class="form-label">Tipo Laboratório</label>
                            <select class="form-select border-0 border-bottom" name="tipo_lab" id="select-box" required>
                            <option value="Ds">Desenvolvimento De Sistemas</option>
                            <option value="Quimica">Quimíca</option>
                            <option value="Nutricao">Nutrição</option>
                            </select>
                        </div>
                </div>


                <div class="text-center">
                    <button type="submit" class="btn-global">Consultar <i class="fas fa-search"></i></button>
                </div>
                </form>
                <!-- Formulario - Fim -->

            </div>
        </div>

        <?php if (isset($laboratorios) && count($laboratorios) > 0): ?>


            <div class="container mt-5">

                <div class="row">

                    <?php foreach ($laboratorios as $lab): ?>


                        <div class="col-md-4">
                            <div class="card mt-5">
                                <img class="card-img-top" src="../img<?= $lab['caminho_img'] ?>" class="rounded shadow">
                                <button class="btn-labs botao-centralizado text-center mb-3"><a id="link-card" class="link-underline link-underline-opacity-0"
                                        href="Formulario_reserva.php?id_lab=<?= $lab['id_lab'] ?>">
                                        <?= $lab['nome_lab'] ?>
                                    </a></button>
                            </div>


                        </div>


                    <?php endforeach ?>
                </div> <!--  div container -->

            <?php elseif (isset($labsNaoDisponiveis)): ?>


                <div id="alert-lab"
                    class="container alert alert-danger text-center w-15 p-0 rounded font-weight-bold shadow-lg mt-5"
                    role="alert">

                    <div id="alert-lab2" class="d-flex justify-content-center text-center">
                        <?= $labsNaoDisponiveis ?>
                        <span class="material-symbols-rounded">report</span></a>
                    </div>
                </div>

            <?php else: ?>

                <div id="alert-lab"
                    class="container alert alert-danger text-center w-15 p-0 rounded font-weight-bold shadow-lg mt-5"
                    role="alert">

                    <div id="alert-lab2" class="d-flex justify-content-center text-center">
                        Informe os dados para consultar os laboratórios disponíveis!
                        <span class="material-symbols-rounded">report</span></a>
                    </div>
                </div>                

            <?php endif ?>

            <!-- Bootstrap JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
                crossorigin="anonymous"></script>
            <script src="../js/calendario_laboratorio.js"></script>
            <script src="../js/mudarestado.js"></script>
            <script src="../js/horarios.js"></script>

</body>

</html>