function selectCarro() {
    let selectElement = document.getElementById('carro');
    selectElement.innerHTML = '';
    fetch('agendamento.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        let carro = data;
        let selectElement = document.getElementById('carro');
        for (let i = 0; i < carro.length; i++) {
            let opcao = document.createElement('option');
            opcao.text = carro[i].modelo;
            selectElement.add(opcao);
        }
    })
    .catch(error => console.error('Erro:', error));
}

function selectAlunos() {
    let selectElement = document.getElementById('aluno');
    selectElement.innerHTML = '';
    fetch('agendamentoAluno.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro na requisição: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        let alunos = data;
        let selectElement = document.getElementById('aluno');
        for (let i = 0; i < alunos.length; i++) {
            let opcao = document.createElement('option');
            opcao.text = alunos[i].nome;
            selectElement.add(opcao);
        }
    })
    .catch(error => console.error('Erro:', error));
}
