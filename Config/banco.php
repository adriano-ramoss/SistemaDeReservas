<?php

//Criação  do banco

include_once('constantes.php');

$conn = new mysqli($db_host, $db_user, $db_pass);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Executar os comandos SQL
$sqlCommands = "
    DROP DATABASE IF EXISTS SistemaReserva;
    CREATE DATABASE IF NOT EXISTS SistemaReserva;
    USE SistemaReserva;

    CREATE TABLE usuarios (
        id_usu INT AUTO_INCREMENT PRIMARY KEY,
        nome_usu VARCHAR(30) NOT NULL,
        cpf_usu VARCHAR(17) NOT NULL,
        senha_usu VARCHAR(70) NOT NULL,
        tipo_usu VARCHAR(30) NOT NULL
    );

    CREATE TABLE laboratorios (
        id_lab INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nome_lab VARCHAR(50) NOT NULL,
        caminho_img VARCHAR(100),
        tipo_lab VARCHAR(50)
    );

    CREATE TABLE reservas (
        id_reserva INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_usu INT NOT NULL,
        id_lab INT NOT NULL,
        turma VARCHAR(20) NOT NULL,
        data_reserva DATE NOT NULL,
        hora_entrada TIME NOT NULL,
        hora_saida TIME NOT NULL,
        periodo_reserva VARCHAR(20) NOT NULL,
        observacoes VARCHAR(255) NULL,
        CONSTRAINT FK_id_usu FOREIGN KEY (id_usu) REFERENCES usuarios(id_usu),
        CONSTRAINT FK_id_lab FOREIGN KEY (id_lab) REFERENCES laboratorios(id_lab)
    );


    DELIMITER //

    CREATE PROCEDURE InserirReserva(
        IN p_id_usu INT,
        IN p_id_lab INT,
        IN p_turma VARCHAR(20),
        IN p_data_reserva DATE,
        IN p_hora_entrada TIME,
        IN p_hora_saida TIME,
        IN p_periodo_reserva VARCHAR(20),
        IN p_observacoes VARCHAR(255)
    )
    BEGIN
        DECLARE existing_reservations INT;

        SELECT COUNT(*) INTO existing_reservations
        FROM reservas
        WHERE id_lab = p_id_lab
        AND data_reserva = p_data_reserva
        AND periodo_reserva = p_periodo_reserva;

        IF existing_reservations = 0 THEN
            INSERT INTO reservas(id_usu, id_lab, turma, data_reserva, hora_entrada, hora_saida, periodo_reserva, observacoes)
            VALUES(p_id_usu, p_id_lab, p_turma, p_data_reserva, p_hora_entrada, p_hora_saida, p_periodo_reserva, p_observacoes);
        ELSE
            SELECT COUNT(*) INTO existing_reservations
            FROM reservas
            WHERE id_lab = p_id_lab
            AND data_reserva = p_data_reserva
            AND periodo_reserva = p_periodo_reserva
            AND (
                (p_hora_entrada BETWEEN hora_entrada AND hora_saida)
                OR (p_hora_saida BETWEEN hora_entrada AND hora_saida)
                OR (p_hora_entrada <= hora_entrada AND p_hora_saida >= hora_saida)
            );

            IF existing_reservations = 0 THEN
                INSERT INTO reservas(id_usu, id_lab, turma, data_reserva, hora_entrada, hora_saida, periodo_reserva, observacoes)
                VALUES(p_id_usu, p_id_lab, p_turma, p_data_reserva, p_hora_entrada, p_hora_saida, p_periodo_reserva, p_observacoes);
            ELSE
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Já existe uma reserva para este laboratório no mesmo período e horário.';
            END IF;
        END IF;
    END;
    //

    DELIMITER ;

";

if ($conn->multi_query($sqlCommands)) {
    echo "Script executado com sucesso.\n";
} else {
    echo "Erro ao executar o script: " . $conn->error . "\n";
}

// Fechar a conexão
$conn->close();

?>