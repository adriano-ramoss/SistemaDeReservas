<?php 

include_once "../../Model/User.php";


$user = new User();

$camposForm = $_POST;

if ($user->verificarDadosPost($camposForm)) {


    $cpf_usu = $camposForm['cpf'];
    $senha_usu = $camposForm['senha'];
    $user->login($cpf_usu, $senha_usu);
    
}




?>