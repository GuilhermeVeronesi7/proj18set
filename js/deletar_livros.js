// js/deletar_livro.js
// (Traduzido de deletar_filme.js)

// Esta URL deve bater com a sua estrutura do XAMPP
// Lembre que o BASE_URL está definido em 'livro_form.php'
const API_URL = `${window.BASE_URL || '/proj18set'}/backend/api.php`;


function deleteLivro(id) {
    // Usamos 'confirm' (como o professor) para confirmar
    if (!confirm("Tem certeza que deseja excluir este livro?")) {
        return; // Para se o usuário clicar em "Cancelar"
    }

    // O fetch agora aponta para a nossa API de Livros
    fetch(`${API_URL}?resource=livros&id=${id}`, {
        method: "DELETE"
    })
    .then(response => {
        if (!response.ok) {
            // Se a API der um erro (ex: 404, 500), trata aqui
            return response.json().then(err => { throw new Error(err.message || "Erro de servidor") });
        }
        return response.json();
    })
    .then(data => {
        alert(data.message || "Livro excluído com sucesso.");

        // Recarrega a página do catálogo para mostrar a lista atualizada
        window.location.reload();
    })
    .catch(err => {
        // Pega erros de 'fetch' (ex: rede caiu) ou os erros que jogamos acima
        alert("Erro ao excluir o livro: " + err.message);
        console.error(err);
    });
}