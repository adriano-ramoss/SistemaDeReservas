<?php

if(!isset($_SESSION)){
    session_start();

}
if($_SESSION['tipo_usu'] === 'Administrador'){
    header("Location: ../adm/Agendamentos.php"); // Redirecione para a tela de login
    exit();
    }

?>