document.getElementById('alunoForm').addEventListener('submit', function(event){ 
    event.preventDefault();

    let nome = document.getElementById('nome').value;
    let cpf = document.getElementById('cpf').value;
    let dataNascimento = document.getElementById('dataNascimento').value;
    let endereco = document.getElementById('endereco').value;
    let telefone = document.getElementById('telefone').value;

    if (nome == '' || cpf == '' || dataNascimento == '' || endereco == '' || telefone == '') {
        alert('Campos obrigatórios não preenchidos!');
        return;
    }

    // Construir um objeto com os dados do aluno
    let alunoData = {
        nome: nome,
        cpf: cpf,
        dataNascimento: dataNascimento,
        endereco: endereco,
        telefone: telefone
    };

    fetch('inserir_aluno.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(alunoData),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao inserir aluno');
        }
        return response.json();
    })
    .then(data => {
        alert('Aluno inserido com sucesso');
    })
    .catch(error => {
        alert(error.message);
    });
});
function buscarAlunos() {
    // Fazer a solicitação AJAX usando Fetch API
    fetch('inserir_aluno.php')
        .then(response => response.json())
        .then(data => {
            // Manipular os dados recebidos e atualizar a tabela
            atualizarTabela(data);
        })
        .catch(error => console.error('Erro ao buscar aluno:', error));
}


function atualizarTabela(data) {
    // Limpar o corpo da tabela
    let tbody = document.getElementById("alunosBody");
    tbody.innerHTML = '';

    // Preencher a tabela com os dados recebidos
    data.forEach(alunos => {
        let row = tbody.insertRow();
        row.insertCell(0).innerHTML = alunos.nome;
        row.insertCell(1).innerHTML = alunos.cpf;
        row.insertCell(2).innerHTML = alunos.data_nascimento;
        row.insertCell(3).innerHTML = alunos.endereco;
        row.insertCell(4).innerHTML = alunos.telefone;
        // Adicione outras colunas conforme necessário
        // ...

        // Adicione coluna de ações (editar, excluir, etc.)
        let actionsCell = row.insertCell(5);
        actionsCell.innerHTML = '<button onclick="redirecionarParaEdicao(' + alunos.id + ')">Editar</button>' +
                                '<button onclick="excluirAluno(' + alunos.id + ')">Excluir</button>';
    });
}
function excluirAluno(id) {
    if (confirm('Tem certeza que deseja excluir este aluno?')) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'inserir_aluno.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('aluno excluído com sucesso');
                // Atualizar a tabela após a exclusão
                buscarAlunos();
            }
        }

        xhr.send('excluir=1&id=' + id);
    }
}

// Adicione esta função para redirecionar para a página de edição
function redirecionarParaEdicao(id) {
    window.location.href = 'editar_aluno.html?id=' + id;
}