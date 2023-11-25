<?php

include_once "../../Model/DbOperacao.php";

$id_usu = $_GET['id_usu'];

$mostrar_usuario = new DbOperacao();

$usuario = $mostrar_usuario->consultarUser($id_usu);

$elemento = $usuario[0];

extract($elemento);

?>