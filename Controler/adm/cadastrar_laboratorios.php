<?php

include_once '../../Model/DbOperacao.php';

$cadastrar_laboratorio = new DbOperacao();

$nome_lab = $_POST['nome-lab'];

$tipo_lab = $_POST['tipo_lab'];

$cadastrar_laboratorio->cadastrarLaboratorios($nome_lab, $tipo_lab);
