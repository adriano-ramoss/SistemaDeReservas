DROP DATABASE IF EXISTS SistemaReserva;
CREATE DATABASE IF NOT EXISTS SistemaReserva;
USE SistemaReserva;

CREATE TABLE usuarios(
    id_usu INT AUTO_INCREMENT PRIMARY KEY,
    nome_usu VARCHAR(30) NOT NULL,
    cpf_usu VARCHAR(17) NOT NULL,
    senha_usu VARCHAR(70) NOT NULL,
    tipo_usu VARCHAR(30) NOT NULL
);


CREATE TABLE laboratorios(
    id_lab INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_lab VARCHAR(50) NOT NULL,
    caminho_img VARCHAR(100),
    tipo_lab VARCHAR(50)
);

CREATE TABLE reservas(
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

-- Exemplo de uso do procedimento armazenado
INSERT INTO laboratorios(nome_lab, caminho_img, tipo_lab)
VALUES
("Laboratorio 1", "/labQuimica.jpeg", "Quimica"),
    ("Laboratorio 2", "/labQuimica.jpeg", "Quimica"),
    ("Laboratorio 3", "/labQuimica.jpeg", "Quimica");

INSERT INTO laboratorios(nome_lab, caminho_img, tipo_lab)
VALUES
("Laboratorio 1", "/labNutricao.jpeg", "Nutricao"),
    ("Laboratorio 2", "/labNutricao.jpeg", "Nutricao"),
    ("Laboratorio 3", "/labNutricao.jpeg", "Nutricao");

INSERT INTO laboratorios(nome_lab, caminho_img, tipo_lab)
VALUES
("Laboratorio 1", "/labDs.jpg", "Ds"),
    ("Laboratorio 2", "/labDs.jpg", "Ds"),
    ("Laboratorio 3", "/labDs.jpg", "Ds");

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

    -- Verificar se já existe uma reserva para o mesmo laboratório, data e período
    SELECT COUNT(*) INTO existing_reservations
    FROM reservas
    WHERE id_lab = p_id_lab
    AND data_reserva = p_data_reserva
    AND periodo_reserva = p_periodo_reserva;

    -- Se não houver reservas conflitantes no mesmo período, insira a nova reserva
    IF existing_reservations = 0 THEN
        INSERT INTO reservas(id_usu, id_lab, turma, data_reserva, hora_entrada, hora_saida, periodo_reserva, observacoes)
        VALUES(p_id_usu, p_id_lab, p_turma, p_data_reserva, p_hora_entrada, p_hora_saida, p_periodo_reserva, p_observacoes);
    ELSE
        -- Verificar conflitos de horários dentro do mesmo período noturno
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

        -- Se não houver conflitos de horários, insira a nova reserva
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

