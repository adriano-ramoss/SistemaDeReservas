<?php

include_once('../../Model/User.php');

if (!isset($_SESSION)) {
    session_start();
}


$id_usu = $_SESSION['id_usu'];
$id_lab = $_SESSION['id_lab'];
$turma = $_POST['turma'];
$periodo = $_SESSION['periodo'];
$data = $_SESSION['data'];
$observacao = $_POST['observacoes'];
$hora_entrada = $_SESSION['hora_entrada'];
$hora_saida = $_SESSION['hora_saida'];

echo $id_usu . " <br>";
echo $id_lab . " <br>";
echo $turma . " <br>";
echo $periodo . " <br>";
echo $data . " <br>";
echo $observacao . " <br>";
echo $hora_entrada . " <br>";
echo $hora_saida . " <br>";


$reservar = new User();

$reservar->reservar($id_usu, $id_lab, $turma, $data, $hora_entrada, $hora_saida, $periodo, $observacao);

header("Location: ../../Views/user/Minhas_reservas.php");

