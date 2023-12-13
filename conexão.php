<?php
class conexao
{
    private $host = "localhost";
    private $port = "3306";
    private $dbname = "autoescola";
    private $user = "root";
    private $pass = "";
    private $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";port=" .$this->port, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Erro ao conectar com o banco: " . $e->getMessage();
        }
    }

    public function executar($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }
}