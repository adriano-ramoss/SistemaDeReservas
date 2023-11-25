<?php

class DbConexao
{
    private $con;

    function __construct()
    {
        // Construtor vazio
    }

    function conexao()
    {
        include_once dirname(__FILE__) . '/../Config/constantes.php';

        try {
            $this->con = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Erro na conexão
            echo "Erro! Banco não encontrado<br>";
            $error = $e->getMessage();
            echo $error;
        }

        return $this->con;
    }
}

?>