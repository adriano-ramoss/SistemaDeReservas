<?php

class User
{

    private $con;

    public function __construct()
    {
        include_once dirname(__FILE__) . '/DbConexao.php';


        $db = new DbConexao();


        $this->con = $db->conexao();
    }


    public function login($cpf_usu, $senha_usu)
    {
        // Inicialize a sessão, se ainda não estiver iniciada
        if (!isset($_SESSION)) {
            session_start();
        }

        // Consulta SQL para buscar o usuário pelo CPF
        $query = "SELECT * FROM usuarios WHERE cpf_usu = :cpf_usu";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":cpf_usu", $cpf_usu);
        $stmt->execute();

        $usuario = $stmt->fetch();

        // Verifique se o usuário foi encontrado
        if ($usuario) {
            if (password_verify($senha_usu, $usuario['senha_usu'])) {
                // Defina as informações do usuário na sessão
                $_SESSION['id_usu'] = $usuario['id_usu'];
                $_SESSION['tipo_usu'] = $usuario['tipo_usu'];

                if ($usuario['tipo_usu'] === 'Professor') {
                    header("Location: ../../Views/user/Laboratorios.php");
                    exit();
                } else {

                    header("Location: ../../Views/adm/Agendamentos.php");
                    exit();
                }
            } else {
                // Senha incorreta
                $_SESSION['mensagemSenha'] = 'Senha inválida, tente novamente.';
            }
        } else {
            // Usuário não encontrado
            $_SESSION['mensagemSenha'] = 'Usuário não encontrado, tente novamente.';
        }

        // Redirecione de volta para a página de login
        header("Location: ../../index.php");
        exit();
    }



    public function ConsultarLabsDisponiveis($periodo, $data, $horario_selecionado, $tipo_lab)
    {
        list($hora_entrada, $hora_saida) = explode(" - ", $horario_selecionado);
        $query = "SELECT l.id_lab, l.nome_lab, l.caminho_img
FROM laboratorios l
WHERE l.id_lab NOT IN (
    SELECT r.id_lab
    FROM reservas r
    WHERE r.data_reserva = :data
    AND r.periodo_reserva = :periodo
    AND (
        (:hora_entrada BETWEEN r.hora_entrada AND r.hora_saida)
        OR (:hora_saida BETWEEN r.hora_entrada AND r.hora_saida)
        OR (:hora_entrada <= r.hora_entrada AND :hora_saida >= r.hora_saida)
    )
) AND l.tipo_lab = :tipo_lab";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":periodo", $periodo);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":hora_entrada", $hora_entrada);
        $stmt->bindParam(":hora_saida", $hora_saida);
        $stmt->bindParam(":tipo_lab", $tipo_lab);

        $stmt->execute();

        $laboratorios = $stmt->fetchAll();

        
        return $laboratorios;
    }


     public function deletarReservas($id_reserva)
    {

        $query = "DELETE FROM reservas WHERE id_reserva = :id_reserva";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_reserva", $id_reserva);

        $stmt->execute();
    }








    public function sair()
    {

        if (!isset($_SESSION)) {
            session_start();
        }

        session_destroy();

        header("Location: ../index.php");
        exit();
    }

    public function verificarDadosPost($camposObrigatorios)
    {

        foreach ($camposObrigatorios as $campos => $valor) {

            if (!isset($valor) || empty($valor)) {
                return false;
            }
        }

        return true;
    }

    public function reservar($id_usu, $id_lab, $turma, $data, $hora_entrada, $hora_saida, $periodo, $observacao)
    {

        $query = "INSERT INTO reservas (id_usu, id_lab, turma, data_reserva, hora_entrada, hora_saida, periodo_reserva, observacoes)
        VALUES (:id_usu, :id_lab, :turma, :data_reserva, :hora_entrada, :hora_saida, :periodo_reserva, :observacoes)";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_usu", $id_usu);
        $stmt->bindParam(":id_lab", $id_lab);
        $stmt->bindParam(":turma", $turma);
        $stmt->bindParam(":data_reserva", $data);
        $stmt->bindParam(":hora_entrada", $hora_entrada);
        $stmt->bindParam(":hora_saida", $hora_saida);
        $stmt->bindParam(":periodo_reserva", $periodo);
        $stmt->bindParam(":observacoes", $observacao);

        try {
            $stmt->execute();
            $_SESSION['msg-sucesso'] = "Reservado com Sucesso";
        } catch (PDOException $e) {
            // Erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }

    public function consultarMinhasReservas($id_usu) // faz a consulta para a tela de Minhas Reservas
    {

        $reservas = [];

        $query = "SELECT r.*, l.tipo_lab, l.nome_lab
            FROM reservas r
            INNER JOIN laboratorios l ON r.id_lab = l.id_lab
            WHERE r.id_usu = :id_usu
        ORDER BY r.data_reserva;";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_usu", $id_usu);

        $stmt->execute();

        $reservas = $stmt->fetchAll();

        return $reservas;
    }
}