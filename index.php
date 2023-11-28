<?php

if(!isset($_SESSION)){
  session_start();

}

if (isset($_SESSION['id_usu']) && $_SESSION['tipo_usu'] === 'Professor') {

    header("Location: Views/user/Laboratorios.php"); 
    exit();

}elseif (isset($_SESSION['id_usu']) && $_SESSION['tipo_usu'] === 'Administrador') {
    header("Location: Views/adm/Agendamentos.php"); 
    exit();

}

// Verificar se há uma mensagem na sessão
if (isset($_SESSION['mensagemSenha'])) {
  $msgError = $_SESSION['mensagemSenha'];
  // Limpar o valor da sessão para não mostrar a mensagem novamente após um novo login
  unset($_SESSION['mensagemSenha']);
}

if (isset($_SESSION['msg-erro'])) {

    $msgError = $_SESSION['msg-erro'];

    unset($_SESSION['msg-erro']);
  
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Google Fonts: Bold 700, Light 300 -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&family=Open+Sans:wght@300;700&display=swap" rel="stylesheet">

  <!-- Css -->
  <link rel="stylesheet" href="Views/css/user/login.css">
  <link rel="stylesheet" href="Views/css/style.css">

 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

  <div class="container-login">

    <div class="content first-content">

      <!-- Primeira coluna -->
      <div class="first-column">
        <img src="Views/img/logo.png" class="img-login">
        <h2 class="title-welcome">Bem-Vindo!</h2>
      </div>

      <!-- Segunda coluna -->
      <div class="second-column">
        <h2 class="title-login">Login</h2>
       
        <form class="form" method="POST" action="Controler/user/login.php">
          <!-- Campo de entrada de CPF -->
          <div class="input-wrapper">
            <i class="fas fa-user input-icon"></i>
            <input type="text" class="input-login" autofocus name="cpf" placeholder="CPF" id="cpf" minlength="14" maxlength="14" required autocomplete="off">
          </div>
          <!-- Campo de entrada de senha -->
          <div class="input-wrapper" style="position: relative;">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" class="input-login" id="senha" name="senha" placeholder="Senha" required autocomplete="off">
             <img class="pass" id="showPassword" src="views/img/show.png" alt="Mostrar Senha" onclick="mostrarSenha()">
          </div>


          <div class="error-message w-1" style="display: <?php echo isset($msgError) ? 'block' : 'none'; ?>">
            <p class="senha-message"><?php echo $msgError; ?></p>
          </div>
          <!-- Botão de Entrar -->
          <button class="btn-global">Entrar</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  
  <script src="Views/js/login.js"></script>
  <script src="Views/js/senha_incorreta.js"></script>


<script src="Views/js/mostrar_senha_login.js"></script>

</body>

</html>