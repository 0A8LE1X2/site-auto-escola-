<?php
include_once "conexão.php";

if ($acao == "agendamento") {
    $aluno = $_POST["aluno"];
    $carro = $_POST["carro"];
    $data = $_POST["data"];
    $horario = $_POST["horario"];

    $sql = "INSERT INTO agendamentos (aluno, carro, data, horario) VALUES ('$aluno', '$carro', '$data', '$horario')";

    if ($conn->query($sql) === TRUE) {
        echo "Aula agendada com sucesso!";
    } else {
        echo "Erro ao agendar aula: " . $conn->error;
    }
}

$conn->close();

if ($acao == "cadatro1") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $dataNascimento = $_POST["dataNascimento"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO alunos (nome, cpf, dataNascimento, endereco, telefone) 
            VALUES ('$nome', '$cpf', '$dataNascimento', '$endereco', '$telefone')";

    if ($conn->query($sql) === TRUE) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar aluno: " . $conn->error;
    }
}

$conn->close();
if ($acao == "cadastro2" ){
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $ano = $_POST["ano"];
    $placa = $_POST["placa"];
    $capacidade = $_POST["capacidade"];
    $stmt = $conexao->prepare("INSERT INTO carros (marca, modelo, ano, placa, capacidade) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $marca, $modelo, $ano, $placa, $capacidade);
    $stmt->execute();

    $stmt->close();
    $conexao->close();
}
?>
