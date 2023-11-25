<?php

include_once("../../Model/User.php");


if (!isset($_SESSION)) {
    session_start();
}

$id_usu = $_SESSION['id_usu'];

$Minhas_reservas = new User();

$reservas = $Minhas_reservas->consultarMinhasReservas($id_usu); //Armazenando os dados do banco no array

?>
