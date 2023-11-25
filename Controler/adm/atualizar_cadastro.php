<?php 

include_once "../../Model/DbOperacao.php";


$camposForm = $_POST;

$atualizar_user  = new DbOperacao();

if ($atualizar_user->verificarDadosPost($camposForm)) {

    $id_usu = $camposForm['id_usu'];
    $nome_usu = $camposForm['nome'];
	$cpf_usu =  $camposForm['cpf'];
	$senha_usu = $camposForm['senha'];
	$tipo_usu = $camposForm['tipo_usu'];

    $atualizar_user->atualizarUser($id_usu, $nome_usu, $cpf_usu, $senha_usu, $tipo_usu);

}

 ?>