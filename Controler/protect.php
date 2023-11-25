<?php
session_start();

// Verifique se o usuário não está autenticado
if (!isset($_SESSION['id_usu'])) {
    $_SESSION['msg-erro'] = "Necessário realizar login para prosseguir!";
    header("Location: ../../index.php"); // Redirecione para a tela de login
    exit();
}
?>