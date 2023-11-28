<?php

if(!isset($_SESSION)){
    session_start();

}
if($_SESSION['tipo_usu'] === 'Professor'){
    header("Location: ../user/Laboratorios.php"); // Redirecione para a tela de login
    exit();
    }

?>