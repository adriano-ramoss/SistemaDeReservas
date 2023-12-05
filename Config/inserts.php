<?php


include_once('constantes.php');

//Inserindo Usuarios e laboratorios no banco

$conn = new mysqli($db_host, $db_user, $db_pass);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$hashProfessor = password_hash('teste123', PASSWORD_DEFAULT);
$hashAdministrador = password_hash('teste123', PASSWORD_DEFAULT);

// Monta a string SQL com os valores calculados
$sqlCommands = "
    USE SistemaReserva;

    INSERT INTO usuarios (nome_usu, cpf_usu, senha_usu, tipo_usu)
    VALUES
    ('Professor', '111.111.111-11', '$hashProfessor', 'Professor'),
    ('Administrador', '222.222.222-22', '$hashAdministrador', 'Administrador');

    INSERT INTO laboratorios (nome_lab, caminho_img, tipo_lab)
    VALUES
    ('Laboratorio 1', '/labQuimica.jpeg', 'Quimica'),
    ('Laboratorio 2', '/labQuimica.jpeg', 'Quimica'),
    ('Laboratorio 3', '/labQuimica.jpeg', 'Quimica'),
    ('Laboratorio 1', '/labNutricao.jpeg', 'Nutricao'),
    ('Laboratorio 2', '/labNutricao.jpeg', 'Nutricao'),
    ('Laboratorio 3', '/labNutricao.jpeg', 'Nutricao'),
    ('Laboratorio 1', '/labDs.jpg', 'Ds'),
    ('Laboratorio 2', '/labDs.jpg', 'Ds'),
    ('Laboratorio 3', '/labDs.jpg', 'Ds'),
    ('Auditório', '/auditorio.jpg', 'Geral');
";

if ($conn->multi_query($sqlCommands)) {
    echo "Script executado com sucesso.\n";
} else {
    echo "Erro ao executar o script: " . $conn->error . "\n";
}

// Fechar a conexão
$conn->close();

?>