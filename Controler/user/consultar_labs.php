<?php

include_once "../../Model/User.php";
if(!isset($_SESSION)){
    session_start();
}

// recebe dados formulario de consulta de laboratorios 

$periodo = $_POST['periodo'];
$data = $_POST['data'];
$tipo_lab = $_POST['tipo_lab'];
$dados = $_POST;
$horario_selecionado = $dados['horario-selecionado'];

// separa o horario selecionado em entrada e saida

list($hora_entrada, $hora_saida) = explode("-", $horario_selecionado);

$_SESSION['data'] = $data;
$_SESSION['hora_entrada'] = $hora_entrada;
$_SESSION['hora_saida'] = $hora_saida;
$_SESSION['periodo'] = $periodo;
$_SESSION['tipo_lab'] = $tipo_lab;

// consulta os laboratorios no banco e mostra para o usuario

$consultar_labs  = new User();

$laboratorios = $consultar_labs->ConsultarLabsDisponiveis($periodo, $data, $horario_selecionado, $tipo_lab);

$_SESSION['laboratorios'] = $laboratorios;

if(count($laboratorios) === 0){

    $_SESSION['LabsNaoDisponiveis'] = "Laboratórios não disponíveis para o horário e período selecionado!";

};

header('Location: ../../Views/user/Laboratorios.php');

?>