<?php
//Crud

class DbOperacao
{

    private $con;


    function __construct()
    {

        include_once dirname(__FILE__) . '/DbConexao.php';


        $db = new DbConexao();


        $this->con = $db->conexao();
    }


    public function verificarDadosPost($camposForm)
    {

        foreach ($camposForm as $campos => $valor) {

            if (!isset($valor) || empty($valor)) {
                return false;
            }
        }

        return true;
    }


    // Cadastrar
    public function cadastrarUser($nome_usu, $cpf_usu, $senha_usu, $tipo_usu)
    {

        $query = "SELECT * FROM usuarios WHERE cpf_usu = :cpf_usu";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":cpf_usu", $cpf_usu);

        $stmt->execute();

        $quantidade = $stmt->rowCount();
        session_start();

        if ($quantidade === 0) {
            $senha_usu = password_hash($senha_usu, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuarios(nome_usu, cpf_usu, senha_usu, tipo_usu) VALUES(:nome_usu, :cpf_usu, :senha_usu, :tipo_usu)";

            $stmt = $this->con->prepare($query);

            $stmt->bindParam(":nome_usu", $nome_usu);
            $stmt->bindParam(":cpf_usu", $cpf_usu);
            $stmt->bindParam(":senha_usu", $senha_usu);
            $stmt->bindParam(":tipo_usu", $tipo_usu);

            try {
                $stmt->execute();
                $_SESSION['msg-sucesso'] = "Usuário cadastrado com sucesso!";
                header("Location: ../../Views/adm/Cadastro_usuario.php");
                exit();
            } catch (PDOException $e) {
                // Erro na conexão
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        } else {
            $_SESSION['msg-cpf'] = "CPF já cadastrado! Informe outro.";
            header("Location: ../../Views/adm/Cadastro_usuario.php");
            exit(); // Importante sair após redirecionamento
        }
    }

    public function cadastrarLaboratorios($nome_lab, $tipo_lab)
    {

        switch ($tipo_lab) {
            case 'Ds':
                $caminho_img = '/labDs.jpg';
                break;
            case 'Quimica':
                $caminho_img = '/labQuimica.jpeg';
                break;
            case 'Nutricao':
                $caminho_img = '/labNutricao.jpeg';
                break;
            default:
                $caminho_img = ''; // Valor padrão caso nenhuma correspondência seja encontrada
        }

        $query = "SELECT * FROM laboratorios WHERE nome_lab = :nome_lab";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":nome_lab", $nome_lab);
        

        $stmt->execute();

        $quantidade = $stmt->rowCount();
        session_start();

        if ($quantidade === 0) {
            $query = "INSERT INTO laboratorios(nome_lab, caminho_img, tipo_lab) VALUES(:nome_lab, :caminho_img, :tipo_lab)";

            $stmt = $this->con->prepare($query);

            $stmt->bindParam(":nome_lab", $nome_lab);
            $stmt->bindParam(":caminho_img", $caminho_img);
            $stmt->bindParam(":tipo_lab", $tipo_lab);

            try {
                $stmt->execute();
                $_SESSION['msg-sucesso'] = "Laboratório cadastrado com Sucesso!";
                header("Location: ../../Views/adm/Cadastro_Laboratorio.php");
                exit();
            } catch (PDOException $e) {
                // Erro na conexão
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        } else {
            $_SESSION['msg-lab'] = "Laboratório já Cadastrado. Informe outro.";
            header("Location: ../../Views/adm/Cadastro_Laboratorio.php");
            exit(); // Importante sair após redirecionamento
        }
    }

    public function deletarUser($id_usu)
    {

        $userId = $this->consultarUser($id_usu);

        $query = "DELETE FROM usuarios WHERE id_usu = :id_usu";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_usu", $id_usu);

        $stmt->execute();

        if ($id_usu === $userId) {

            header("Location: ../../index.php");
            exit();
        }

        header("Location: ../../Views/adm/Professores.php");
        exit();
    }

   public function deletarLab($id_lab)
{
    // Inicie uma transação
    $this->con->beginTransaction();

    try {
        // Primeiro, exclua as reservas associadas a este laboratório
        $queryDeleteReservas = "DELETE FROM reservas WHERE id_lab = :id_lab";
        $stmtDeleteReservas = $this->con->prepare($queryDeleteReservas);
        $stmtDeleteReservas->bindParam(":id_lab", $id_lab);
        $stmtDeleteReservas->execute();

        // Em seguida, exclua o laboratório
        $queryDeleteLab = "DELETE FROM laboratorios WHERE id_lab = :id_lab";
        $stmtDeleteLab = $this->con->prepare($queryDeleteLab);
        $stmtDeleteLab->bindParam(":id_lab", $id_lab);
        $stmtDeleteLab->execute();

        // Faça commit da transação se tudo correr bem
        $this->con->commit();

        header("Location: ../../Views/adm/Laboratorios.php");
    } catch (PDOException $e) {
        // Caso ocorra algum erro, faça rollback da transação
        $this->con->rollBack();
        // Trate o erro de acordo com suas necessidades (por exemplo, exibindo uma mensagem de erro)
        echo "Erro: " . $e->getMessage();
    }
}   

    public function atualizarUser($id_usu, $nome, $cpf, $senha,  $tipo_usu)
    {

        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET nome_usu = :nome_usu, cpf_usu = :cpf_usu, senha_usu = :senha_usu, tipo_usu = :tipo_usu WHERE id_usu = :id_usu";


        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_usu", $id_usu);
        $stmt->bindParam(":nome_usu", $nome);
        $stmt->bindParam(":cpf_usu", $cpf);
        $stmt->bindParam(":senha_usu", $senha);
        $stmt->bindParam(":tipo_usu", $tipo_usu);


        try {

            $stmt->execute();
            header("Location: ../../Views/adm/Professores.php");
            exit();
        } catch (PDOException $e) {
            // Erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
            exit();
        }
    }

    public function atualizarLab($id_lab, $nome_lab){

        $query = "UPDATE laboratorios set nome_lab = :nome_lab";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_lab", $id_lab);
        $stmt->bindParam(":nome_lab", $nome_lab);

        try{
            $stmt->execute();
            session_start();
            $_SESSION['msg-sucesso'] = "Laboratorio Atualizado com sucesso!";
            header("Location: ../../Views/adm/");
            exit();
        }catch(PDOException $e){
            //erro de conexão
            $error = $e->getMessage();
            echo "Erro: $error";
            exit();
        }
    }


    //Consultar Todos os Usuarios
    public function  consultarUsers()
    {

        $usuarios = [];

        $query = "SELECT * FROM usuarios";

        $stmt = $this->con->prepare($query);

        $stmt->execute();

        $usuarios = $stmt->fetchAll();

        return $usuarios;
    }

    //Consulta somente um usuário com base no ID
    public function  consultarUser($id_usu)
    {

        $usuario = [];

        $query = "SELECT * FROM usuarios WHERE id_usu = :id_usu";


        $stmt = $this->con->prepare($query);


        $stmt->bindParam(":id_usu", $id_usu);

        $stmt->execute();

        $usuario = $stmt->fetchAll();

        return $usuario;
    }

    public function consultarLabsCadastrados()
    {
        $laboratorios = [];

        $query = "SELECT * FROM laboratorios";

        $stmt = $this->con->prepare($query);

        $stmt->execute();

        $laboratorios = $stmt->fetchAll();

        return $laboratorios;
    }
    //Consulta somente um laboratorio com base no ID
    public function consultarLab()
    {

        $laboratorio = [];

        $query = "SELECT * FROM laboratorios WHERE id_lab = :id_lab";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_lab", $id_lab);

        $stmt->execute();

        $laboratorio = $stmt->fetchAll();

        return $laboratorio;
    }

    public function consultarAgendamentos()
    {

        $agendamentos = [];

        $startDate = date('Y-m-d');
        $finalDate = date('Y-m-d', strtotime('+1 month'));

        $query = "SELECT
            r.id_reserva AS id_reserva,
            l.nome_lab AS nome_lab,
            u.nome_usu AS nome_usu,
            r.turma AS turma,
            r.hora_entrada AS hora_entrada,
            r.hora_saida AS hora_saida,
            r.data_reserva AS data
        FROM
            reservas r
        JOIN
            usuarios u ON r.id_usu = u.id_usu
        JOIN
            laboratorios l ON r.id_lab = l.id_lab;";

        $stmt = $this->con->prepare($query);

        $stmt->execute();

        $agendamentos = $stmt->fetchAll();

        return $agendamentos;

        // $sql2 = "SELECT rs.*, nome AS nome_usuario from reservas rs 
        // INNER JOIN usuarios us ON rs.id_usuario = us.nome 
        // WHERE rs.data_reserva BETWEEN '$startDate' AND '$finalDate'";
    }



    public function deletarReservas($id_reserva)
    {

        $query = "DELETE FROM reservas WHERE id_reserva = :id_reserva";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":id_reserva", $id_reserva);

        $stmt->execute();
    }


}
