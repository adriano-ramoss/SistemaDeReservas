<?php
include_once("../../Controler/protectUser.php");
include_once("../../Controler/user/minhas_reservas.php");

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['msg-sucesso'])) {
  $msg = '<p class="alert alert-success">' . $_SESSION['msg-sucesso'] . '</p>';
  unset($_SESSION['msg-sucesso']);
}

if(isset($_SESSION['laboratorios'])){

  unset($_SESSION['laboratorios']);
  
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
  
  <link rel="stylesheet" href="../css/user/minhas_reservas.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css"> <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservas</title>
</head>

<body>

  <!-- NavBar para mobile -->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">

    <a class="navbar-brand" href="#"><img style="height: 50px; width: 50px; margin-left: 4vh;" src="../img/logo.png"></a>

    <a class="nav-link text-white" id="navtext">Sistema de Gerenciamento</a>
    <div class="mobile-menu" onclick="Mudarestado('hidden')">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
    </div>
    <ul id="hidden" class="hidden" style="display: none;">
      <li class="nav-item">
        <a class="nav-link text-white" style="text-align: center;" href="Laboratorios.php">Laboratório & Auditorios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" id="navexit" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>

    <!-- NavBar pc -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto" id="navlist">
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 10vh;" href="Laboratorios.php">Laboratórios & Auditorios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- NavBar FIM -->
<!--  -->


<div class="message" style="display: <?php echo isset($msg) ? 'block' : 'none'; ?>">
    <div class="d-flex justify-content-center align-items-center" style="height: 15vh;">
        <?= $msg ?>
    </div>
</div>



  <?php if (count($reservas) > 0) : ?>

    <h2 id="titulo">Minhas Reservas</h2>

    <!-- INICIO TABELA -->

    <div class="table">
      <div class="table_section">
        <table>
          <thead>
            <tr class="text-center">
              <th id="th-left">Nome Do Laboratorios</th>
              <th>Tipo Do Laboratórios</th>
              <th>Turma</th>
              <th>Horario Entrada</th>
              <th>Horario Saída</th>
              <th>Data Da Reserva</th>
              <th id="th-right">Ação</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($reservas as $reserva) : ?>
              <tr>
                <td><?= $reserva['nome_lab']; ?></td>
                <td><?= $reserva['tipo_lab']; ?></td>
                <td><?= $reserva['turma']; ?></td>
                <td><?= $reserva['hora_entrada']; ?></td>
                <td><?= $reserva['hora_saida']; ?></td>
                <td><?= $reserva['data_reserva']; ?></td>
              <td>
                <form method="POST" action="../../Controler/user/deletar_minhasReservas.php">


                  <!-- Inputs invisiveis - inicio -->
                  <input type="hidden" name="type" value="delete">

                  <input type="hidden" name="id_reserva" value="<?= $reserva["id_reserva"] ?>">
                  <button id="btn-delete"><span class="material-symbols-rounded">delete</span></button>

                </form>

              </td>

          </tbody>
          </tr>

        <?php endforeach ?>
        </table>
      </div>
    </div>

  <?php else : ?>

    <h2 id="titulo">Reservas</h2>

    <div class="container alert alert-danger text-center w-25 p-3 rounded font-weight-bold shadow-lg" role="alert">

      <div class="d-flex justify-content-center">
        Ainda não há reservas cadastradas
        <span class="material-symbols-rounded">report</span></a>
      </div>
      <br>
      <div>
        <p>
          Clique <a class="btn btn-primary btn-sm" href="Laboratorios.php" role="button" id="link-cadastro">aqui</a> para reservar
        </p>
      </div>

    </div>



  <?php endif ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="../js/cadastro.js"></script>
  <script src="../js/msg_cadastro.js"></script>
  <script src="../js/mudarestado.js"></script>
  <script src="../js/temporizadorMSG.js"></script>
</body>

</html>