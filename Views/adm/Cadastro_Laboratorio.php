<?php

include_once("../../Controler/protectAdm.php");

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['msg-lab'])) {
    $msg = '<p class="alert alert-danger">' . $_SESSION['msg-cpf'] . '</p>';
    unset($_SESSION['msg-lab']);
}

if (isset($_SESSION['msg-sucesso'])) {
    $msg = '<p class="alert alert-success">' . $_SESSION['msg-sucesso'] . '</p>';
    unset($_SESSION['msg-sucesso']);

} elseif (isset($_SESSION['msg-erro'])) {
    $msg = '<p class="alert alert-danger">' . $_SESSION['msg-erro'] . '</p>';
    ;
    unset($_SESSION['msg-erro']);
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/adm/cadastro_usuario.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cadastro</title>
</head>

<body>
    <!-- NavBar para mobile -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">

        <a class="navbar-brand" href="#"><img style="height: 50px; width: 50px; margin-left: 4vh;"
                src="../img/logo.png"></a>

        <a class="nav-link text-white" id="navtext">Coordenação</a>
        <div class="mobile-menu" onclick="Mudarestado('hidden')">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul id="hidden" class="hidden" style="display: none;">
             <li class="nav-item">
                <a class="nav-link text-white" href="Laboratorios.php">Laboratórios</a>
                <a class="nav-link text-white" style="text-align: center;" href="Cadastro_usuario.php">Cadastrar</a>
      </li>
            <li class="nav-item">
                <a class="nav-link text-white" style="text-align: center;" href="Agendamentos.php">Agendamentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="Professores.php">Usuários</a>
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
                    <a class="nav-link text-white" style="margin-right: 5vh;" href="Laboratorios.php">Laboratórios</a>
                    <li class="nav-item">
                    <a class="nav-link text-white" style="margin-right: 5vh;" href="Cadastro_usuario.php">Cadastro</a>
                    <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link text-white" style="margin-right: 5vh;" href="Agendamentos.php">Agendamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="Professores.php" style="margin-right: 10vh;"
                        href="Professores.php">Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;"
                        href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>

        </div>
    </nav>
    <!-- NavBar FIM -->



    <div class="container-login">
        <div class="content first-content">



            <!-- primeira coluna -->
            <div class="first-column">
                <h2 class="title-login" style="text-align: center;">Cadastro de <br> Laboratórios</h2>


                <div class="message" style="display: <?php echo isset($msg) ? 'block' : 'none'; ?>">
                    <?= $msg ?>
                </div>

                <form class="form" method="POST" action="../../Controler/adm/cadastrar_laboratorios.php">
                    <!-- Campo de entrada de Nome -->
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" autofocus class="input-login" name="nome-lab"
                            placeholder="Nome do Laboratorio" id="nome-lab" required autocomplete="off">
                    </div>

                     <div class="input-wrapper">
                        <select class="input-login" name="tipo_lab" id="select-box" required>
                            <option class="font-weight-bold" value="" hidden>Tipo De Laboratório</option>
                            <option value="Ds">Desenvolvimento De Sistemas</option>
                            <option value="Quimica">Quimíca</option>
                            <option value="Nutricao">Nutrição</option>
                        </select>
                    </div>
            </div>

            <div class="second-column" style="margin-top: 50px;">
                <div class="text-second">

                    <img src="../img/logo.png" class="img-login">
                    <h2 class="title-welcome" style="font-size: 35px; font-weight: bold;">Coordenação</h2>
                    <p class="description" style="margin-bottom: 100px;">Sistema de Controle e<br> Gerenciamento de
                        Laboratório<br>e Auditório</p>

                </div>
                <!-- Botão de Entrar -->
                <button class="btn-global">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="../js/cadastro.js"></script>
    <script src="../js/msg_hidden.js"></script>
    <script src="../js/mudarestado.js"></script>
    <script src="../js/temporizadorMSG.js"></script>

</body>

</html>