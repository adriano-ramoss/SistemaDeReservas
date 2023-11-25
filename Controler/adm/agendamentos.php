<?php 

include_once("../../Model/DbOperacao.php");

$agendamentos = new DbOperacao();

$reservas = $agendamentos->consultarAgendamentos();



 ?>