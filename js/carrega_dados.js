// 2. Carga de dados via javascript (carrega_dados.js)

document.addEventListener("DOMContentLoaded", () => {
  // Seleciona o corpo da tabela onde os dados serão inseridos
  const tbody = document.getElementById("tabela-livros-body");

  // 2a. Busca (fetch) o arquivo JSON
  fetch('dados.json')
    .then(response => {
      // Verifica se a requisição foi bem sucedida
      if (!response.ok) {
        throw new Error('Erro ao carregar o arquivo JSON: ' + response.statusText);
      }
      // Converte a resposta para JSON
      return response.json();
    })
    .then(data => {
      // 2a. Itera sobre cada objeto 'livro' no array de dados
      data.forEach(livro => {
        // Cria uma nova linha (tr)
        const row = document.createElement('tr');
        row.className = 'destaque-livro'; // Mantém a classe do seu CSS

        // Cria e preenche as células (td) da linha
        row.innerHTML = `
          <td><img src="${livro.capa}" alt="Capa do livro ${livro.titulo}"></td>
          <td>${livro.titulo}</td>
          <td>${livro.genero}</td>
          <td>${livro.editora}</td>
          <td>${livro.autor}</td>
        `;

        // Adiciona a linha preenchida ao corpo da tabela
        tbody.appendChild(row);
      });
    })
    .catch(error => {
      // Trata qualquer erro que ocorra durante o fetch
      console.error('Erro na operação de fetch:', error);
      const row = document.createElement('tr');
      row.innerHTML = `<td colspan="5">Não foi possível carregar os livros. Tente novamente mais tarde.</td>`;
      tbody.appendChild(row);
    });
});