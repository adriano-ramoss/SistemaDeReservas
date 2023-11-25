<?php 

include_once("../../Model/DbOperacao.php");

//Arquivo para mostrar Professores
$mostrar_labs = new DbOperacao();

$laboratorios = $mostrar_labs->consultarLabsCadastrados(); //Armazenado os dados do banco no array

?>