// js/livro.js
// (Traduzido de filme.js do professor)
// Este JS cuida do formulário de CADASTRO e EDIÇÃO

// 1. Pega as variáveis que o PHP 'imprimiu' na página
const action = window.LIVRO_ACTION; // 'novo' or 'editar'
const livroId = window.LIVRO_ID;     // o ID (se for 'editar')
const baseUrl = window.BASE_URL || '/proj18set';

// 2. Define a URL da nossa API
const API_URL = `${baseUrl}/backend/api.php`;

// 3. Pega os elementos do formulário e do modal
const form = document.getElementById("form_livro");
const modalOverlay = document.getElementById("modalOverlay");
const modalMessage = document.getElementById("modalMessage");
const btnModalOK = document.getElementById("btnModalOK");

/* (Opcional) A lógica de carregar dados para edição
   O professor 'filme_form.php' já faz isso com PHP, 
   então o JS de carregar dados para edição (que o professor 
   comentou no filme.js) não é necessário.
*/

// 4. Listener do SUBMIT (quando o usuário clica em "Cadastrar" ou "Salvar")
form.addEventListener("submit", async function(e) {
    e.preventDefault(); // Impede o formulário de recarregar a página

    // 5. Monta o 'payload': um objeto JSON com os dados do livro
    const payload = {
        titulo: document.getElementById("titulo").value,
        autor: document.getElementById("autor").value,
        editora: document.getElementById("editora").value,
        genero: document.getElementById("genero").value,
        capa: document.getElementById("capa").value
    };

    // 6. Define a URL e o Método (POST ou PUT)
    let url = `${API_URL}?resource=livros`;
    let method = "POST"; // Padrão é 'POST' (Criar)

    if (action === "editar") {
        method = "PUT"; // Se for edição, mudamos para 'PUT'
        url += `&id=${livroId}`; // E adicionamos o ID na URL
    }

    // 7. Faz a chamada (fetch) para a API
    try {
        const response = await fetch(url, {
            method: method,
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(payload) // Converte o objeto JS em texto JSON
        });

        const result = await response.json();

        if (response.ok) {
            // Se a API retornou 200 (OK) ou 201 (Created)
            modalMessage.innerText = result.message;
        } else {
            // Se a API retornou um erro (400, 404, 500)
            modalMessage.innerText = `Erro: ${result.message}`;
        }
        
        modalOverlay.style.display = "flex"; // Mostra o modal de feedback

    } catch (error) {
        // Se o 'fetch' em si falhar (ex: sem internet)
        modalMessage.innerText = "Erro de conexão. Tente novamente.";
        modalOverlay.style.display = "flex";
    }
});

// 8. Botão OK do modal
// Redireciona o usuário de volta para o catálogo após o feedback
btnModalOK.addEventListener("click", function() {
    window.location.href = `${baseUrl}/catalogo.php`;
});