<?php 

include_once '../../Model/DbOperacao.php';


$cadastrar_usuario = new DbOperacao();

$camposForm = $_POST;

	$nome_usu = $camposForm['nome'];
	$cpf_usu = $camposForm['cpf'];
	$senha_usu = $camposForm['senha'];
	$tipo_usu = $camposForm['tipo_usu'];

	
	$cadastrar_usuario->cadastrarUser($nome_usu, $cpf_usu, $senha_usu, $tipo_usu);

?>