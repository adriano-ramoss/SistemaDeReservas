<?php 

include_once "../../Model/DbOperacao.php";


$opcao = $_POST;

$id_usu = $_POST['id_usu'];

$Deletar_user = new DbOperacao();



if ($opcao['type'] === 'delete') {

	$Deletar_user->deletarUser($id_usu);
	
	
}


 ?>