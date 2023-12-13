<?php
include_once "conexão.php";
$conn = new conexao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carroId = $_POST['carroId'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $capacidade = $_POST['capacidade'];

    // Executa a atualização do carro
    $sql = "UPDATE carros SET marca = '$marca', modelo = '$modelo', ano = '$ano', placa = '$placa', capacidade_passageiros = '$capacidade' WHERE id = '$carroId'";
    $conn->executar($sql);

    echo "carro editado com sucesso";
} else {
    // Se não for uma requisição de POST, retorna um erro ou trata conforme necessário
    echo "Erro: Método de requisição inválido.";
}

// Fecha a conexão
//$conn->close();
?>
