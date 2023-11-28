<?php

include_once("../../Config/url.php");
include_once("../../Controler/adm/editar_cadastro.php");
include_once("../../Controler/protectAdm.php");

if (!isset($_SESSION)) {
  session_start();
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/adm//edicao_cadastro.css">


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Cadastro</title>
</head>

<body>
  <!-- NavBar para mobile -->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">

    <a class="navbar-brand" href="#"><img style="height: 50px; width: 50px; margin-left: 4vh;" src="../img/logo.png"></a>

    <a class="nav-link text-white" id="navtext">Coordenação</a>
    <div class="mobile-menu" onclick="Mudarestado('hidden')">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
    </div>
    <ul id="hidden" class="hidden" style="display: none;">
      <li class="nav-item">
          <a class="nav-link text-white" href="Laboratorios.php">Laboratórios</a>
      <li class="nav-item">
          <a class="nav-link text-white" href="Cadastro_Laboratorio.php">Cadastrar Laboratório</a>
      <li class="nav-item">
        <a class="nav-link text-white" style="text-align: center;" href="Agendamentos.php">Agendamentos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="Professores.php">Usuários</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="Cadastro_usuario.php">Cadastrar</a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" id="navexit" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>

    <!-- NavBar pc -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto" id="navlist">
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 5vh;" href="Laboratorios.php">Laboratórios</a>
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 5vh;" href="Cadastro_Laboratorio.php">Cadastrar Laboratório</a>
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 5vh;" href="Agendamentos.php">Agendamentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 5vh;" href="Professores.php">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 10vh;" href="Cadastro_usuario.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;" href="../../Controler/logout.php">Sair<i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- NavBar FIM -->




  <div class="container-login">
    <div class="content first-content">



      <!-- primeira coluna -->
      <div class="first-column">
        <h2 class="title-login" style="text-align: center;">Edição de <br> Cadastro</h2>

        <form class="form" method="POST" action="../../Controler/adm/atualizar_cadastro.php">
          <!-- Campo de entrada de Nome -->

          <div class="input-wrapper">

            <input type="hidden" name="type" value="delete">

            <input type="hidden" name="id_usu" value="<?= $id_usu ?>">


            <i class="fas fa-user input-icon"></i>
            <input type="text" autofocus value="<?= $nome_usu; ?>" class="input-login" name="nome" placeholder="Nome" id="nome" required>
          </div>
          <!-- Campo de entrada de CPF -->
          <div class="input-wrapper">
            <i class="fas fa-user input-icon"></i>
            <input type="text" class="input-login" value="<?= $cpf_usu ?>" name="cpf" placeholder="CPF" id="cpf" minlength="14" maxlength="14" required>
          </div>
          <!-- Campo de entrada de senha -->
          <div class="input-wrapper">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" class="input-login" name="senha" id="senha" placeholder="Senha" required>
            <img class="pass" id="showPassword" src="../img/show.png" alt="Mostrar Senha" onclick="mostrarSenha()">
          </div>

          <!-- Campo de entrada de periodo -->

          <!-- Campo de entrada de tipo de usuario -->
          <div class="input-wrapper" style="margin-bottom: 100px;">

            <select class="input-login" name="tipo_usu" id="select-box" value="<?= $tipo_usu ?>" required>
              <option value="" hidden> Tipo de usuário</option>
              <option value="Professor" <?= ($tipo_usu === 'Professor') ? 'selected' : '' ?>>Professor</option>
              <option value="Administrador" <?= ($tipo_usu === 'Administrador') ? 'selected' : '' ?>>Administrador</option>

            </select>
          </div>




          <!-- segunda coluna -->

      </div>

      <div class="second-column" style="margin-top: 50px;">
        <div class="text-second">

          <img src="../img/logo.png" class="img-login">
          <h2 class="title-welcome" style="font-size: 35px; font-weight: bold;">Coordenação</h2>
          <p class="description" style="margin-bottom: 100px;">Sistema de Controle e<br> Gerenciamento de Laboratório<br>e Auditório</p>

        </div>
        <!-- Botão de Entrar -->
        <button class="btn-global">Atualizar</button>

        </form>

      </div>
    </div>
  </div>



  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="../js/cadastro.js"></script>
  <script src="../js/mudarestado.js"></script>
  <script src="../js/mostrar_senha_adm.js"></script>

</body>

</html>