<?php
include_once "conexão.php";
$conn = new conexao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se a solicitação é para exclusão
    if (isset($_POST['excluir']) && $_POST['excluir'] == 1) {
        $id = $_POST['id'];

        $sql = "DELETE FROM carros WHERE id = '$id'";
        $conn->executar($sql);

        echo "carro excluído com sucesso";
    } else {
        // Se não for uma solicitação de exclusão, trata como uma solicitação de inserção

        // Obter os dados do formulário
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $placa  = $_POST['placa'];
        $capacidade = $_POST['capacidade'];

        // Executa a inserção
        $sql = "INSERT INTO carros (marca, modelo, ano, placa, capacidade_passageiros) VALUES ('$marca', '$modelo', '$ano', '$placa', '$capacidade')";
        $conn->executar($sql);

        echo "carro inserido com sucesso";
    }
} else {
    // Se não for uma requisição de POST, retorna a listagem de carros

    // Executa a consulta para selecionar todos os carros
    $sql = "SELECT * FROM carros";

    // Executa a consulta
    $result = $conn->executar($sql);

    // Verifica os resultados
    if (sizeof($result) > 0) {
        $carros = array();

        // Busca os resultados como array associativo
        foreach ($result as $row) {
            $carros[] = $row;
        }

        // Retorna os resultados como JSON
        echo json_encode($carros);
    } else {
        // Retorna um array vazio se não houver resultados
        echo json_encode(array());
    }
}

// Fecha a conexão
//$conn->close();
?>
