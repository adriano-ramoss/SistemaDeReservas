<?php 

include_once '../../Model/DbOperacao.php';

$id_lab = $_POST['id_lab'];

$deletar_laboratorio = new DbOperacao();

$deletar_laboratorio->deletarLab($id_lab);

?>