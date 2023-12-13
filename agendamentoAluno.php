<?php
include_once "conexão.php";
$conn = new conexao();

$sql = "SELECT nome FROM alunos";

// Executa uma consulta
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
?>