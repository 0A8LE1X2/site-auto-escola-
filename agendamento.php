<?php
include_once "conexão.php";
$conn= new conexao();

    $sql = "SELECT modelo FROM carros";

    // Executa uma consulta
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
?>