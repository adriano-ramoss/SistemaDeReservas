<?php
include_once "../../Controler/adm/agendamentos.php";
include_once("../../Controler/protect.php");

if (!isset($_SESSION)) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Poppins:wght@500&display=swap" rel="stylesheet">

  <!-- CSS -->

  <link rel="stylesheet" href="../css/agendamentos.css">
  <link rel="stylesheet" href="../css/style.css">


  <!-- BOOTSTRAP -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- CSS -->

  <link rel="stylesheet" href="../css/adm/agendamentos.css">
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title class="lg p-3 mb-5">Agendamentos</title>
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
        <a class="nav-link text-white" style="text-align: center;" href="Cadastro_usuario.php">Cadastrar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="Professores.php">Usuários</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" id="navexit" href="../../Controler/logout">Sair <i class="fas fa-sign-out-alt"></i></a>
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
          <a class="nav-link text-white" style="margin-right: 5vh;" href="Cadastro_usuario.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="Professores.php" style="margin-right: 10vh;">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- NavBar FIM -->
  <h2 id="titulo">Agendamentos</h2>

  <?php if (count($reservas) > 0) : ?>

    <!-- INICIO TABELA -->

    <div class="table">
      <div class="table_section">
        <table>
          <thead>
            <tr class="text-center">
              <th id="th-left">Nº Reserva</th>
              <th>Sala</th>
              <th>Professor</th>
              <th>Turma</th>
              <th>Horario Entrada</th>
              <th>Horario Saída</th>
              <th>Data</th>
              <th id="th-right">Ação</th>
            </tr>
          </thead>


          <tbody style="font-weight: bold;" class="text-center">

            <?php foreach ($reservas as $reserva) : ?>

              <td><?= $reserva['id_reserva'];  ?></td>
              <td><?= $reserva['nome_lab'];  ?></td>
              <td><?= $reserva['nome_usu'];  ?></td>
              <td><?= $reserva['turma'];  ?></td>
              <td><?= $reserva['hora_entrada'];  ?></td>
              <td><?= $reserva['hora_saida'];  ?></td>
              <td><?= $reserva['data'];  ?></td>

              <td>
                <form method="POST" action="../../Controler/adm/deletar_reservas.php">


                  <!-- Inputs invisiveis - inicio -->
                  <input type="hidden" name="type" value="delete">

                  <input type="hidden" name="id_reserva" value="<?= $reserva["id_reserva"] ?>">
                  <button id="btn-delete"><span class="material-symbols-rounded">delete</span></button>

                </form>

              </td>

              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>


  <?php else : ?>

    <div class="container alert alert-danger text-center w-25 p-3 rounded font-weight-bold shadow-lg" role="alert">

      <div id="alert-lab2" class="d-flex justify-content-center">
        Ainda não há agendamentos
        <span class="material-symbols-rounded">report</span></a>
      </div>
    </div>


  <?php endif; ?>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="../js/cadastro.js"></script>
  <script src="../js/mudarestado.js"></script>

</body>

</html>