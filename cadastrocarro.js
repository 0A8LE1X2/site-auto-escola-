document.getElementById('cadastro2').addEventListener('submit', function(event) {
    event.preventDefault();

    let marca = document.getElementById('marca').value;
    let modelo = document.getElementById('modelo').value;
    let ano = document.getElementById('ano').value;
    let placa = document.getElementById('placa').value;
    let capacidade = document.getElementById('capacidade').value;

    if (marca == '' || modelo == '' || ano == '' || placa == '' || capacidade == '') {
        alert('Campos obrigatórios não preenchidos!');
        return;
    }

    // Verificar qual botão foi clicado
    let isBuscarButton = event.submitter.id === 'buscarButton';

    if (isBuscarButton) {
        // Se o botão de buscar foi clicado, realizar a busca
        buscarCarro();
    } else {
        // Se o botão de cadastrar foi clicado, realizar a inserção
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'inserir_carro.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Carro inserido com sucesso');
                // Atualizar a tabela após a inserção
                buscarCarro();
            }
        }

        xhr.send('marca=' + marca + '&modelo=' + modelo + '&ano=' + ano + '&placa=' + placa + '&capacidade=' + capacidade);
    }
});

function buscarCarro() {
    // Fazer a solicitação AJAX usando Fetch API
    fetch('inserir_carro.php')
        .then(response => response.json())
        .then(data => {
            // Manipular os dados recebidos e atualizar a tabela
            atualizarTabela(data);
        })
        .catch(error => console.error('Erro ao buscar carros:', error));
}

// Restante do seu código permanece o mesmo...


function atualizarTabela(data) {
    // Limpar o corpo da tabela
    let tbody = document.getElementById("carrosBody");
    tbody.innerHTML = '';

    // Preencher a tabela com os dados recebidos
    data.forEach(carros => {
        let row = tbody.insertRow();
        row.insertCell(0).innerHTML = carros.marca;
        row.insertCell(1).innerHTML = carros.modelo;
        row.insertCell(2).innerHTML = carros.ano;
        row.insertCell(3).innerHTML = carros.placa;
        row.insertCell(4).innerHTML = carros.capacidade_passageiros;
        // Adicione outras colunas conforme necessário
        // ...

        // Adicione coluna de ações (editar, excluir, etc.)
        let actionsCell = row.insertCell(5);
        actionsCell.innerHTML = '<button onclick="redirecionarParaEdicao(' + carros.id + ')">Editar</button>' +
                                '<button onclick="excluirCarro(' + carros.id + ')">Excluir</button>';
    });
}

function excluirCarro(id) {
    if (confirm('Tem certeza que deseja excluir este carro?')) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'inserir_carro.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Carro excluído com sucesso');
                // Atualizar a tabela após a exclusão
                buscarCarro();
            }
        }

        xhr.send('excluir=1&id=' + id);
    }
}

// Adicione esta função para redirecionar para a página de edição
function redirecionarParaEdicao(id) {
    window.location.href = 'editar_carro.html?id=' + id;
}