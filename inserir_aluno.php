<?php
include_once "conexão.php";
$conn = new conexao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter o conteúdo JSON
    $json_data = file_get_contents("php://input");
    
    // Decodificar o JSON para um array associativo
    $data = json_decode($json_data, true);

    // Verificar se a solicitação é para exclusão
    if (isset($data['excluir']) && $data['excluir'] == 1) {
        $id = $data['id'];

        $sql = "DELETE FROM alunos WHERE id = '$id'";
        $conn->executar($sql);

        echo "aluno excluído com sucesso";
    } else {
        // Se não for uma solicitação de exclusão, trata como uma solicitação de inserção

        // Obter os dados do formulário
        $nome = $data['nome'];
        $cpf = $data['cpf'];
        $dataNascimento = $data['dataNascimento'];
        $endereco  = $data['endereco'];
        $telefone = $data['telefone'];

        // Executa a inserção
        $sql = "INSERT INTO alunos (nome, cpf, data_nascimento, endereco, telefone) VALUES ('$nome', '$cpf', '$dataNascimento', '$endereco', '$telefone')";
        $conn->executar($sql);

        echo "aluno inserido com sucesso";
    }
} else {
    // Se não for uma requisição de POST, retorna a listagem de carros

    // Executa a consulta para selecionar todos os carros
    $sql = "SELECT * FROM alunos";

    // Executa a consulta
    $result = $conn->executar($sql);

    // Verifica os resultados
    if (sizeof($result) > 0) {
        $alunos = array();

        // Busca os resultados como array associativo
        foreach ($result as $row) {
            $alunos[] = $row;
        }

        // Retorna os resultados como JSON
        echo json_encode($alunos);
    } else {
        // Retorna um array vazio se não houver resultados
        echo json_encode(array());
    }
}

// Fecha a conexão
//$conn->close();
?>
