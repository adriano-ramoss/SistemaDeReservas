
<?php 


include_once "../../Model/User.php";


$opcao = $_POST;

$id_reserva = $_POST['id_reserva'];

$deletar_reservas = new User();



if ($opcao['type'] === 'delete') {

	$deletar_reservas->deletarReservas($id_reserva);
	header("Location: ../../Views/user/Minhas_reservas.php");
	exit();

}


 ?>
