<?php
// livro_form.php
// (Traduzido de filme_form.php do professor)
// Este é o formulário para CADASTRAR (Create) e EDITAR (Update)

require_once __DIR__ . '/backend/dbconfig.php';
require_once __DIR__ . '/backend/livros_dao.php';

$action = $_GET['action'] ?? 'novo';
$id = $_GET['id'] ?? null;

$livro = [
    'titulo' => '',
    'genero' => '',
    'capa' => '',
    'editora' => '',
    'autor' => ''
];

// Se for 'editar', buscamos o livro no banco para preencher o formulário
if ($action === 'editar' && $id) {
    $pdo = getDbConnection();
    $livro = readLivros($pdo, $id);
    if (!$livro) {
        die("Livro não encontrado.");
    }
}

$pageTitle = ($action === 'editar') ? 'Editar Livro' : 'Cadastrar Livro';
include 'header.php';
include 'nav.php';
?>

<main>
    <h2><?= $pageTitle ?></h2>
    
    <!-- Este é o formulário de CADASTRO, não o de SAC -->
    <!-- Ele usa o 'id="form_livro"' que o JS vai procurar -->
    <form id="form_livro">
        
        <!-- Campo Título -->
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required><br><br>
        
        <!-- Campo Autor -->
        <label for="autor">Autor:</label><br>
        <input type="text" id="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required><br><br>
        
        <!-- Campo Editora -->
        <label for="editora">Editora:</label><br>
        <input type="text" id="editora" value="<?= htmlspecialchars($livro['editora']) ?>" required><br><br>

        <!-- Campo Gênero -->
        <label for="genero">Gênero:</label><br>
        <input type="text" id="genero" value="<?= htmlspecialchars($livro['genero']) ?>"><br><br>

        <!-- Campo Capa (URL) -->
        <label for="capa">URL da Capa:</label><br>
        <input type="text" id="capa" value="<?= htmlspecialchars($livro['capa']) ?>" placeholder="Ex: img/codigo_limpo.jpg"><br><br>

        <button type="submit">
            <?= $action == 'editar' ? 'Salvar Alterações' : 'Cadastrar Livro' ?>
        </button>
    </form>
</main>

<!-- Modal para mensagens (igual ao do professor) -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <h3 id="modalMessage">Mensagem aqui</h3>
        <button id="btnModalOK">OK</button>
    </div>
</div>

<?php 
include 'footer.php'; // Inclui o rodapé
?>

<!-- 
  Scripts específicos para este formulário
-->
<!-- Passa as variáveis 'action' e 'id' do PHP para o JavaScript -->
<script>
    window.LIVRO_ACTION = "<?= $action ?>";
    window.LIVRO_ID = "<?= $id ?>";
    window.BASE_URL = "<?= BASE_URL ?>"; // Passa a URL base para o JS
</script>
<script src="<?= BASE_URL ?>/js/livro.js" defer></script>
<!-- Adicionamos o CSS do Modal (que está no style.css) -->
<style>
/* CSS do Modal (copiado do professor para garantir) */
.modal-overlay {
    display: none; 
    position: fixed;
    top: 0; 
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}
.modal {
    background: var(--cor-fundo-conteudo);
    padding: 2rem;
    border: 2px solid var(--cor-dourado-destaque);
    max-width: 400px;
    width: 90%;
    text-align: center;
}
.modal button {
    background: var(--cor-primaria-media);
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    font-family: 'Playfair Display', serif;
    margin-top: 1rem;
    cursor: pointer;
}
</style>