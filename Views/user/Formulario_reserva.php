<?php
include_once("../../Controler/protectUser.php");

if (!isset($_SESSION)) {
  session_start();
}

$id_lab = $_GET['id_lab'];
$_SESSION['id_lab'] = $id_lab;




if(isset($_SESSION['laboratorios'])){

  unset($_SESSION['laboratorios']);

}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário para Reserva</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Poppins:wght@500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../../Views/css/user/formulario_reserva.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <a class="nav-link text-white" href="Laboratorios.php">Laboratório & Auditório</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="Minhas_reservas.php">Reservas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" id="navexit" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>

    <!-- NavBar pc -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto" id="navlist">
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 10vh;" href="Laboratorios.php">Laboratórios & Auditório</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" style="margin-right: 10vh;" href="Minhas_reservas.php">Reservas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" id="navexit" style="margin-right: 5vh;" href="../../Controler/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- NavBar FIM -->

  <h2 id="titulo" class="text-center p-3">Preencha o formulário para reservar</h2>

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">

        <div class="box">
          <form action="../../Controler/user/reservar.php" method="POST">

            <div class="mb-3">
              <label for="periodo" class="form-label">Selecione sua turma</label>
              <select class="form-select border-0 border-bottom" name="turma" id="idTurma">
              <?php if($_SESSION['tipo_lab'] == 'Ds'): ?>
              
                <option value="DS 1H" selected>DS 1H</option>
                <option value="DS 2H">DS 2H</option>
                <option value="DS 3H">DS 3H</option>
                <option value="ADM 3H">ADM 1H</option>
                <option value="ADM 2H">ADM 2H</option>
                <option value="ADM 1H">ADM 3H</option>
                <option value="Quimica 1H">Quimica 1H</option>
                <option value="Quimica 2H">Quimica 2H</option>
                <option value="Quimica 3H">Quimica 3H</option>
                <option value="Nutrição 1H">Nutrição 1H</option>
                <option value="Nutrição 2H">Nutrição 2H</option>
                <option value="Nutrição 3H">Nutrição 3H</option>


                <?php elseif($_SESSION['tipo_lab'] == 'Quimica'):?>
                  <option value="Quimica 1H" selected>Quimica 1H</option>
                  <option value="Quimica 2H">Quimica 2H</option>
                  <option value="Quimica 3H">Quimica 3H</option>

                <?php elseif($_SESSION['tipo_lab'] == 'Nutricao'):?>
                  <option value="Nutrição 1H" selected>Nutrição 1H</option>
                  <option value="Nutrição 2H">Nutrição 2H</option>
                  <option value="Nutrição 3H">Nutrição 3H</option>
              <?php endif ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Data</label>
              <input type="date" required name="data" value="<?= $data = $_SESSION['data']; ?>" class="form-control border-0 border-bottom" min="2023-01-01" readonly max="2024-01-01" id="input-data">
            </div>

            <div class="mb-3">
              <p class="mb-3">Período Selecionado</p>

                <input class=" form-control border-0 border-bottom" readonly name="periodo" value="<?= $_SESSION['periodo']?>" id="periodo">
                

            </div>

            <div class="mb-3">
              <p  class="form-label">Horário De Entrada</p>
              <input type="text" readonly class="form-control border-0 border-bottom" value="<?= $_SESSION['hora_entrada']; ?>" name="hora_entrada" >
            </div>

            <div class="mb-3">
              <p  class="form-label">Horário De Saída</p>
              <input type="text" readonly class="form-control border-0 border-bottom" value="<?= $_SESSION['hora_saida']; ?>" name="hora_saida" >
            </div>

            <div class="mb-3">
              <p  class="form-label">Tipo do Laboratorio</p>
              <input type="text" readonly class="form-control border-0 border-bottom" value="<?= $_SESSION['tipo_lab']; ?>" name="tipo_lab" >
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Observações</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" maxlength="255" name="observacoes"></textarea>
            </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn-global">Enviar <i class="fa-solid fa-paper-plane"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../../Views/js/formReserva.js"></script>
  <script src="../js/mudarestado.js"></script>
  <script></script>
</body>

</html>