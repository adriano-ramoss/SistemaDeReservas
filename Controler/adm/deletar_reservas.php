<?php 


include_once "../../Model/DbOperacao.php";


$opcao = $_POST;

$id_reserva = $_POST['id_reserva'];

$deletar_reservas = new DbOperacao();



if ($opcao['type'] === 'delete') {

	$deletar_reservas->deletarReservas($id_reserva);
	header("Location: ../../Views/adm/Agendamentos.php");
	exit();

}
 ?>