<?php

include_once("../../Controler/protectAdm.php");
include_once("../../Controler/adm/professores.php");
include_once("../../Config/url.php");

if (!isset($_SESSION)) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="stylesheet" href="../css/adm/professores.css">
  <link rel="stylesheet" href="../css/style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Poppins:wght@500&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professores</title>
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
          <a class="nav-link text-white" style="margin-right: 10vh;" href="Cadastro_usuario.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- NavBar FIM -->

  <div class="message" style="display: <?php echo isset($msg) ? 'block' : 'none'; ?>">
    <?= $msg ?>
  </div>

  <!-- INICIO TABELA -->

  <?php if (count($usuarios) > 0) : ?>
    <div class="table">

      <div class="table_section">
        <h2 id="titulo">Professores</h2>
        <table>
          <thead>
            <tr class="text-center">
              <th id="th-left">Nº ID</th>
              <th>CPF</th>
              <th>Professor</th>
              <th>Tipo De Usuário</th>
              <th id="th-right">Ação</th>
            </tr>
          </thead>
          <tbody style="font-weight: bold;">

            <?php foreach ($usuarios as $usuario) : ?>
              <tr>
                <td><?= $usuario['id_usu']; ?></td>
                <td><?= $usuario['cpf_usu']; ?></td>
                <td><?= $usuario['nome_usu']; ?></td>
                <td><?= $usuario['tipo_usu']; ?></td>


                <td>

                  <!-- Deletar usuarios - inicio -->
                  <form method="POST" action="../../Controler/adm/deletar_usuario.php">


                    <!-- Inputs invisiveis - inicio -->
                    <input type="hidden" name="type" value="delete">

                    <input type="hidden" name="id_usu" value="<?= $usuario["id_usu"] ?>">
                    <!-- Inputs invisiveis - Fim -->

                    <div class="btn-group" role="group" arial-label="Grupo de botões">

                      <button id="btn-delete" class="btn btn-primary"><span class="material-symbols-rounded">delete</span></button>

                  </form><!-- Deletar usuarios - fim -->


                  <!-- Editar Usuarios - inicio -->

                  <a id="btn-edit" class="btn btn-secondary" role="Button" href="<?= $BASE_URL ?>Edicao_cadastro.php?id_usu=<?= $usuario['id_usu'] ?>"><span class="material-symbols-rounded">edit</span></a>

                  <!-- Editar Usuarios - fi -->

      </div>
      </td>
      </tr>



    <?php endforeach ?>


    </tbody>
    </table>
    </div>
    </div>

  <?php else : ?>

    <h2 id="titulo">Professores</h2>

    <div class="container alert alert-danger text-center w-25 p-3 rounded font-weight-bold shadow-lg" role="alert">

      <div class="d-flex justify-content-center">
        Ainda não há usuários cadastrados
        <span class="material-symbols-rounded">report</span></a>
      </div>
      <br>
      <div>
        <p>
          Clique <a class="btn btn-primary btn-sm" href="Cadastro_usuario.php" role="button" id="link-cadastro">aqui</a> para cadastrar
        </p>
      </div>

    </div>


  <?php endif ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="../js/cadastro.js"></script>
  <script src="../js/mudarestado.js"></script>
</body>

</html>