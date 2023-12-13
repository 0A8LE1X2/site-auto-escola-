<?php
include_once "conexão.php";
$conn = new conexao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alunoId = $_POST['alunoId'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['dataNascimento'];
    $endereco = $_POST['endereco'];
    $telefone =$_POST['telefone'];
    // Executa a atualização do aluno
    $sql = "UPDATE alunos SET nome = '$nome', cpf = '$cpf', dataNascimento = '$dataNascimento', endereco = '$endereco',telefone = '$telefone' WHERE id = '$alunoId'";
    $conn->executar($sql);

    echo "Aluno editado com sucesso";
} else {
    // Se não for uma requisição de POST, retorna um erro ou trata conforme necessário
    echo "Erro: Método de requisição inválido.";
}

// Fecha a conexão
//$conn->close();
?>
