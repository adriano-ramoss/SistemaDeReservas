<?php 

include_once("../../Model/DbOperacao.php");

//Arquivo para mostrar Professores
$mostrar_usuarios = new DbOperacao();

$usuarios = $mostrar_usuarios->consultarUsers(); //Armazenado os dados do banco no array

?>